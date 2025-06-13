<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleIn;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']);
    }

    public function index()
    {
        // Total kendaraan
        $total_vehicles = \App\Models\Vehicle::count();

        // Kendaraan masuk hari ini (VehicleIn)
        $total_vehicle_in = \App\Models\VehicleIn::whereDate('created_at', now()->format('Y-m-d'))->count();

        // Kendaraan keluar hari ini (VehicleOut)
        $total_vehicle_out = \App\Models\VehicleOut::whereDate('created_at', now()->format('Y-m-d'))->count();

        // Total keuntungan
        $total_amount = \App\Models\Parking::sum('total_fee');

        return view('backend.home', [
            'vehicles' => \App\Models\Vehicle::get(),
            'total_vehicles' => $total_vehicles,
            'total_vehicle_in' => $total_vehicle_in,
            'total_vehicle_out' => $total_vehicle_out,
            'total_amount' => $total_amount
        ]);
    }
}
