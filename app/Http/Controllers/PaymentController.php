<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\VehicleIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout($vehicleInId)
    {
        $vehicleIn = VehicleIn::with(['vehicle.category'])->findOrFail($vehicleInId);
        $amount = $vehicleIn->vehicle->category->fee_per_hour * $vehicleIn->duration;

        return view('frontend.checkout', compact('vehicleIn', 'amount'));
    }

    public function processPayment(Request $request, $vehicleInId)
    {
        $request->validate([
            'payment_method' => 'required|in:transfer,qris',
            'proof_image' => 'required|image|max:2048'
        ]);

        $vehicleIn = VehicleIn::with(['vehicle.category'])->findOrFail($vehicleInId);
        $amount = $vehicleIn->vehicle->category->fee_per_hour * $vehicleIn->duration;

        // Store proof image
        $image = $request->file('proof_image');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('payment_proofs', $filename, 'public');

        // Create payment record
        $payment = Payment::create([
            'vehicle_in_id' => $vehicleInId,
            'amount' => $amount,
            'payment_method' => $request->payment_method,
            'proof_image' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('frontend.payment.waiting', $payment->id)
            ->with('success', 'Pembayaran sedang diproses. Mohon tunggu konfirmasi dari admin.');
    }

    public function waitingConfirmation($paymentId)
    {
        $payment = Payment::with(['vehicleIn.vehicle'])->findOrFail($paymentId);
        return view('frontend.payment_waiting', compact('payment'));
    }

    // Admin Methods
    public function adminIndex()
    {
        $payments = Payment::with(['vehicleIn.vehicle.customer', 'vehicleIn.slot'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('backend.payments.index', compact('payments'));
    }

    public function adminConfirm(Request $request, $paymentId)
    {
        try {
            DB::beginTransaction();

            $payment = Payment::findOrFail($paymentId);

            if ($payment->status !== 'pending') {
                throw new \Exception('Pembayaran ini sudah diproses sebelumnya.');
            }

            // Update status pembayaran
            $payment->update([
                'status' => 'confirmed',
                'notes' => $request->notes,
                'confirmed_at' => now(),
                'confirmed_by' => Auth::id()
            ]);

            // Update status kendaraan (VehicleIn) menjadi Ongoing (1)
            if ($payment->vehicleIn) {
                $payment->vehicleIn->update(['status' => 1]);
                // Update status slot parkir menjadi 'occupied' jika ada
                if ($payment->vehicleIn->slot) {
                    $payment->vehicleIn->slot->update(['status' => 'occupied']);
                }
            }

            DB::commit();

            return redirect()->route('backend.payments.index')
                ->with('success', 'Pembayaran berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('backend.payments.index')
                ->with('error', 'Gagal mengkonfirmasi pembayaran: ' . $e->getMessage());
        }
    }

    public function adminReject(Request $request, $paymentId)
    {
        try {
            // Start transaction
            DB::beginTransaction();

            // Find payment
            $payment = Payment::with(['vehicleIn'])->findOrFail($paymentId);

            // Check if payment can be rejected
            if ($payment->status !== 'pending') {
                throw new \Exception('Pembayaran ini sudah diproses sebelumnya.');
            }

            // Validate rejection reason
            $validated = $request->validate([
                'rejection_reason' => 'required|string|min:10',
            ], [
                'rejection_reason.required' => 'Alasan penolakan harus diisi.',
                'rejection_reason.min' => 'Alasan penolakan minimal 10 karakter.'
            ]);

            // Update payment status
            $payment->status = 'rejected';
            $payment->notes = $validated['rejection_reason'];
            $payment->rejected_at = now();
            $payment->rejected_by = Auth::id();
            $payment->save();

            // Update associated parking slot status to 'available'
            if ($payment->vehicleIn && $payment->vehicleIn->slot) {
                $payment->vehicleIn->slot->update(['status' => 'available', 'vehicle_in_id' => null]);
            }

            // Commit transaction
            DB::commit();

            // Log success
            Log::info('Payment rejected successfully', [
                'payment_id' => $paymentId,
                'rejected_by' => Auth::id(),
                'reason' => $validated['rejection_reason']
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pembayaran berhasil ditolak.',
                    'data' => [
                        'payment_id' => $payment->id,
                        'status' => $payment->status,
                        'notes' => $payment->notes
                    ]
                ]);
            }

            return redirect()->route('backend.payments.index')
                ->with('success', 'Pembayaran berhasil ditolak.');

        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollback();

            // Log error
            Log::error('Payment rejection failed', [
                'payment_id' => $paymentId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menolak pembayaran: ' . $e->getMessage()
                ], 422);
            }

            return redirect()->route('backend.payments.index')
                ->with('error', 'Gagal menolak pembayaran: ' . $e->getMessage());
        }
    }

    // Add a new method to check payment status
    public function checkStatus($paymentId)
    {
        try {
            $payment = Payment::findOrFail($paymentId);
            return response()->json([
                'success' => true,
                'status' => $payment->status,
                'notes' => $payment->notes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil status pembayaran'
            ], 404);
        }
    }
}
