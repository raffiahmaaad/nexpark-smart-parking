<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleIn;
use App\Http\Requests\StoreVehicleInRequest;
use App\Http\Requests\UpdateVehicleInRequest;

class VehicleInController extends Controller
{

    public function index()
    {
        return view(
            'backend.vehicles_in.index',
            [
                'vehiclesIn' => VehicleIn::with([
                    'vehicle' => function ($query) {
                        $query->select('id', 'name', 'registration_number', 'customer_id', 'category_id');
                    },
                    'vehicle.customer:id,name',
                    'vehicle.category:id,name',
                    'user:id,name'
                ])
                    ->where('status', 1)
                    ->latest()
                    ->get(),

                'vehiclesIn_History' => VehicleIn::with([
                    'vehicle' => function ($query) {
                        $query->select('id', 'name', 'registration_number', 'customer_id', 'category_id');
                    },
                    'vehicle.customer:id,name',
                    'vehicle.category:id,name',
                    'user:id,name'
                ])
                    ->where('status', '!=', 1)
                    ->latest()
                    ->get()
            ]
        );
    }

    public function create()
    {
        return view('backend.vehicles_in.create', ['vehicles' => Vehicle::get(['id', 'name', 'registration_number'])]);
    }

    public function store(StoreVehicleInRequest $request)
    {
        $data = $request->all();
        $data['status'] = 1; // Memastikan status ongoing saat create for VehicleIn
        $vehicleIn = VehicleIn::updateOrCreate(['id' => $request->vehiclesIn_id], $data);

        // Update the associated Vehicle status to active (1)
        if ($vehicleIn->vehicle) {
            $vehicleIn->vehicle->update(['status' => 1]);
        }

        return redirect()->route('backend.vehiclesIn.index')->with('success', 'Vehicle Entered Successfully!!');
    }

    public function show(VehicleIn $vehiclesIn)
    {
        // Eager load necessary relationships with specific columns
        $vehicleIn = $vehiclesIn->load([
            'vehicle' => function ($query) {
                $query->select('id', 'name', 'registration_number', 'customer_id', 'category_id', 'plat_number');
            },
            'vehicle.customer:id,name,email',
            'vehicle.category:id,name,fee_per_hour'
        ]);

        return view('backend.vehicles_in.show', compact('vehicleIn'), ['vehicles' => Vehicle::get(['id', 'name', 'registration_number'])]);
    }

    public function edit(VehicleIn $vehiclesIn)
    {
        return view('backend.vehicles_in.edit', compact('vehiclesIn'), ['vehicles' => Vehicle::get(['id', 'name', 'registration_number'])]);
    }

    public function update(UpdateVehicleInRequest $request, VehicleIn $vehiclesIn)
    {
        //
    }

    public function destroy(VehicleIn $vehiclesIn)
    {
        $vehiclesIn->delete();
        return redirect()->route('backend.vehiclesIn.index')->with('success', 'Vehicle In Deleted Successfully!!');
    }
}
