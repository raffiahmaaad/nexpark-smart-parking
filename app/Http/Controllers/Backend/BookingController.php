<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['customer', 'vehicle'])->latest()->get();

        $pendingBookings = $bookings->where('status', 'pending')->count();
        $confirmedBookings = $bookings->where('status', 'confirmed')->count();
        $cancelledBookings = $bookings->where('status', 'cancelled')->count();
        $totalIncome = $bookings->where('status', 'confirmed')->sum('total_price');

        // Statistik slot parkir
        $slotTersedia = ParkingSlot::where('status', 'available')->count();
        $slotDipesan = ParkingSlot::where('status', 'booked')->count();
        $slotTerisi = ParkingSlot::where('status', 'occupied')->count();

        return view('backend.dashboard', compact(
            'bookings',
            'pendingBookings',
            'confirmedBookings',
            'cancelledBookings',
            'totalIncome',
            'slotTersedia',
            'slotDipesan',
            'slotTerisi'
        ));
    }

    public function show(Booking $booking)
    {
        $booking->load(['customer', 'vehicle']);
        return view('backend.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $booking->update($validated);

        return redirect()->route('backend.dashboard')
            ->with('success', 'Status booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('backend.dashboard')
            ->with('success', 'Booking berhasil dihapus.');
    }
}
