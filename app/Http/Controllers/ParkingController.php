<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Vehicle;
use App\Models\Parking;
use App\Models\VehicleIn;
use App\Models\ParkingSlot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParkingController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer.auth');
    }

    public function form()
    {
        $categories = Category::all();

        // Get all parking slots grouped by area
        $parkingAreas = ParkingSlot::select('area_name')->distinct()->pluck('area_name');

        // Calculate available and total slots for each area
        $availableSlots = [];
        $totalSlots = [];
        $bookedSlots = [];
        $occupiedSlots = [];

        foreach ($parkingAreas as $area) {
            $areaSlots = ParkingSlot::where('area_name', $area);
            $availableSlots[$area] = $areaSlots->where('status', 'available')->count();
            $totalSlots[$area] = $areaSlots->count();

            // Get booked and occupied slot numbers
            $bookedSlots = array_merge(
                $bookedSlots,
                $areaSlots->where('status', 'booked')->pluck('slot_number')->toArray()
            );
            $occupiedSlots = array_merge(
                $occupiedSlots,
                $areaSlots->where('status', 'occupied')->pluck('slot_number')->toArray()
            );
        }

        // Get base fee for initial display
        $baseFee = Category::min('fee_per_hour') ?? 0;

        // Generate temporary registration number
        $registration_number = $this->generateUniqueRegistrationNumber();

        return view('frontend.parking_form', compact(
            'categories',
            'parkingAreas',
            'availableSlots',
            'totalSlots',
            'bookedSlots',
            'occupiedSlots',
            'baseFee',
            'registration_number'
        ));
    }

    public function book(Request $request)
    {
        // Log the incoming request
        Log::info('Parking booking request:', [
            'request_data' => $request->all(),
            'session_data' => Session::all()
        ]);

        try {
            // Enhanced validation rules
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'vehicle_name' => 'required|string|max:255',
                'plat_number' => 'required|string|regex:/^[A-Z0-9 ]+$/i|max:10',
                'duration' => 'required|integer|min:1|max:24',
                'parking_slot_id' => 'required|exists:parking_slots,id',
                'registration_number' => 'required|string|unique:vehicles,registration_number'
            ], [
                'plat_number.regex' => 'Format plat nomor tidak valid. Gunakan huruf dan angka saja.',
                'duration.max' => 'Durasi parkir maksimal 24 jam.',
                'duration.min' => 'Durasi parkir minimal 1 jam.',
                'category_id.required' => 'Silakan pilih kategori kendaraan.',
                'parking_slot_id.required' => 'Silakan pilih slot parkir.',
                'registration_number.unique' => 'Nomor registrasi sudah digunakan.'
            ]);

            // Verify customer session
            if (!Session::has('customer_email') || !Session::has('customer_id')) {
                throw new \Exception('Sesi login Anda telah berakhir. Silakan login kembali.');
            }

            // Start database transaction with retry
            return DB::transaction(function () use ($request) {
                // Log transaction start
                Log::info('Starting parking booking transaction');

                // Verify slot is still available with lock
                $slot = ParkingSlot::lockForUpdate()->findOrFail($request->parking_slot_id);
                if ($slot->status !== 'available') {
                    Log::warning('Slot not available:', ['slot_id' => $slot->id, 'status' => $slot->status]);
                    throw new \Exception('Maaf, slot parkir ini sudah tidak tersedia. Silakan pilih slot lain.');
                }

                // Get or create customer with error handling
                try {
                    $customer = \App\Models\Customer::firstOrCreate(
                        ['email' => Session::get('customer_email')],
                        [
                            'name' => Session::get('customer_name'),
                            'google_id' => Session::get('customer_id'),
                            'avatar' => Session::get('customer_avatar')
                        ]
                    );
                } catch (\Exception $e) {
                    Log::error('Failed to create/get customer:', ['error' => $e->getMessage()]);
                    throw new \Exception('Gagal memproses data pelanggan. Silakan coba lagi.');
                }

                Log::info('Customer retrieved/created:', ['customer_id' => $customer->id]);

                // Use the provided registration number
                $registration_number = $request->registration_number;

                // Create vehicle with error handling
                try {
                    $vehicle = Vehicle::create([
                        'name' => $request->vehicle_name,
                        'plat_number' => strtoupper($request->plat_number),
                        'category_id' => $request->category_id,
                        'customer_id' => $customer->id,
                        'registration_number' => $registration_number,
                        'duration' => $request->duration,
                        'status' => 1,
                        'created_by' => null
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to create vehicle:', ['error' => $e->getMessage()]);
                    throw new \Exception('Gagal menyimpan data kendaraan. Silakan coba lagi.');
                }

                Log::info('Vehicle created:', ['vehicle_id' => $vehicle->id]);

                // Calculate fee
                $category = Category::findOrFail($request->category_id);
                $total_fee = $category->fee_per_hour * $request->duration;

                // Create vehicle in entry with error handling
                try {
                    $vehicleIn = VehicleIn::create([
                        'vehicle_id' => $vehicle->id,
                        'parking_slot_id' => $slot->id,
                        'parking_number' => $slot->slot_number,
                        'parking_area' => $slot->area_name,
                        'duration' => $request->duration,
                        'status' => 1,
                        'created_by' => null
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to create vehicle in record:', ['error' => $e->getMessage()]);
                    throw new \Exception('Gagal memproses data parkir. Silakan coba lagi.');
                }

                Log::info('VehicleIn created:', ['vehicle_in_id' => $vehicleIn->id]);

                // Update slot status with error handling
                try {
                    $slot->update([
                        'status' => 'booked',
                        'vehicle_in_id' => $vehicleIn->id
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to update slot status:', ['error' => $e->getMessage()]);
                    throw new \Exception('Gagal mengupdate status slot parkir. Silakan coba lagi.');
                }

                Log::info('Slot updated:', ['slot_id' => $slot->id, 'new_status' => 'booked']);

                // Create initial parking record with error handling
                try {
                    $parking = Parking::create([
                        'vehicle_in_id' => $vehicleIn->id,
                        'duration' => $request->duration,
                        'total_fee' => $total_fee,
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to create parking record:', ['error' => $e->getMessage()]);
                    throw new \Exception('Gagal menyimpan data parkir. Silakan coba lagi.');
                }

                Log::info('Parking record created:', ['parking_id' => $parking->id]);

                // Log successful booking
                Log::info('Parking booking completed successfully', [
                    'vehicle_in_id' => $vehicleIn->id,
                    'customer_id' => $customer->id,
                    'slot_id' => $slot->id,
                    'registration_number' => $registration_number
                ]);

                return redirect()->route('frontend.payment.checkout', $vehicleIn->id)
                    ->with('success', 'Booking berhasil dibuat. Silakan lakukan pembayaran.');
            }, 3); // Retry transaction up to 3 times
        } catch (\Exception $e) {
            Log::error('Booking failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function generateUniqueRegistrationNumber()
    {
        do {
            $number = 'PKR-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Vehicle::where('registration_number', $number)->exists());

        return $number;
    }

    public function getAvailableSlots()
    {
        $slots = ParkingSlot::where('status', 'available')
            ->orderBy('area_name')
            ->orderBy('slot_number')
            ->get()
            ->groupBy('area_name');

        return response()->json($slots);
    }

    public function receipt($vehicleInId)
    {
        $vehicleIn = VehicleIn::with(['vehicle.category', 'vehicle.customer'])
            ->findOrFail($vehicleInId);

        $payment = \App\Models\Payment::where('vehicle_in_id', $vehicleInId)
            ->latest()
            ->firstOrFail();

        return view('frontend.parking_receipt', compact('vehicleIn', 'payment'));
    }

    public function exit(Request $request)
    {
        $request->validate([
            'vehicle_in_id' => 'required|exists:vehicle_ins,id',
        ]);

        $vehicleIn = \App\Models\VehicleIn::with('slot')->findOrFail($request->vehicle_in_id);

        // Cek apakah sudah keluar
        if ($vehicleIn->status != 1) {
            return back()->with('error', 'Kendaraan sudah keluar atau tidak valid.');
        }

        // Insert ke tabel VehicleOut, waktu keluar otomatis dari created_at
        \App\Models\VehicleOut::create([
            'vehicleIn_id' => $vehicleIn->id,
        ]);

        // Update status VehicleIn
        $vehicleIn->status = 2; // 2 = sudah keluar
        $vehicleIn->save();

        // Update status slot menjadi available
        if ($vehicleIn->slot) {
            $vehicleIn->slot->status = 'available';
            $vehicleIn->slot->vehicle_in_id = null;
            $vehicleIn->slot->save();
        }

        return back()->with('success', 'Kendaraan berhasil keluar parkir!');
    }
}
