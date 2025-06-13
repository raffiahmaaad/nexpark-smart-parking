<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleOut;
use App\Http\Requests\StoreVehicleOutRequest;
use App\Http\Requests\UpdateVehicleOutRequest;
use App\Models\VehicleIn;

class VehicleOutController extends Controller
{

    public function index()
    {
        $vehiclesOut = \App\Models\VehicleOut::with(['vehicleIn.vehicle:id,name,registration_number', 'user:id,name'])
            ->whereHas('vehicleIn', function ($query) {
                $query->where('status', 2)
                    ->whereHas('payment', function ($q) {
                        $q->where('status', 'confirmed');
                    });
            })
            ->get();
        return view('backend.vehicles_out.index', ['vehiclesOut' => $vehiclesOut]);
    }

    public function create()
    {
        return view('backend.vehicles_out.create', [
            'vehiclesIn' =>
                VehicleIn::with('vehicle:id,name,registration_number')
                    ->where('status', 0)->get(['id', 'vehicle_id'])
        ]);
    }

    public function store(StoreVehicleOutRequest $request)
    {
        // Get vehicle in data
        $vehicleIn = VehicleIn::with('vehicle.category')->find($request->vehicleIn_id);

        // Calculate total fee
        $total_fee = $vehicleIn->vehicle->category->fee_per_hour * $vehicleIn->duration;

        // Create parking record
        \App\Models\Parking::create([
            'vehicle_in_id' => $vehicleIn->id,
            'total_fee' => $total_fee,
            'duration' => $vehicleIn->duration
        ]);

        // Create vehicle out record
        VehicleOut::updateOrCreate(['id' => $request->vehiclesOut_id], $request->all());

        // Update vehicle in status to completed (2)
        $vehicleIn->update(['status' => 2]);

        // Update the associated parking slot status to 'available'
        if ($vehicleIn->parking_slot) {
            $vehicleIn->parking_slot->update(['status' => 'available', 'vehicle_in_id' => null]);
        }

        // Update vehicle status to inactive (0)
        // if ($vehicleIn->vehicle) {
        //     $vehicleIn->vehicle->update(['status' => 0]);
        // }

        return redirect()->route('backend.vehiclesOut.index')->with('success', 'Vehicle Out Successfully!!');
    }

    public function show(VehicleOut $vehiclesOut)
    {
        return view('backend.vehicles_out.show', compact('VehicleOut'), ['vehicles' => Vehicle::get(['id', 'name', 'registration_number'])]);
    }

    public function edit(VehicleOut $vehiclesOut)
    {
        return view('backend.vehicles_out.edit', compact('vehiclesOut'), ['vehicles' => Vehicle::get(['id', 'name', 'registration_number'])]);
    }

    public function update(UpdateVehicleOutRequest $request, VehicleOut $vehiclesOut)
    {
        //
    }

    public function destroy(VehicleOut $vehiclesOut)
    {
        $vehiclesOut->delete();
        return redirect()->route('backend.vehiclesOut.index')->with('success', 'Vehicle Out Deleted Successfully!!');
    }
}
