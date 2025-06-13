<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class ParkingSlotController extends Controller
{
    public function index()
    {
        $slots = ParkingSlot::with('vehicle_in.vehicle')->get();

        $availableCount = $slots->where('status', 'available')->count();
        $bookedCount = $slots->where('status', 'booked')->count();
        $occupiedCount = $slots->where('status', 'occupied')->count();

        return view('backend.parking_slots.index', compact(
            'slots',
            'availableCount',
            'bookedCount',
            'occupiedCount'
        ));
    }
}
