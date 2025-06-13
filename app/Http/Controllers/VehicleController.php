<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function index()
    {
        return view(
            'backend.vehicles.index',
            [
                'vehicles' =>
                    Vehicle::with([
                        'customer:id,name',
                        'user:id,name',
                        'category:id,name,fee_per_hour'
                    ])->get()
            ]
        );
    }

    public function create()
    {
        return view('backend.vehicles.create', [
            'categories' => Category::get(['id', 'name']),
            'customers' => Customer::get(['id', 'name'])
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'plat_number' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'customer_id' => 'required|exists:customers,id',
            'duration' => 'required|integer|min:1',
        ]);
        try {
            Vehicle::updateOrCreate(['id' => $request->vehicle_id], $request->except('vehicle_id', 'status') + ['status' => 1]);
            return redirect()->route('backend.vehicles.index')->with('success', $request->vehicle_id ? 'Vehicle Updated Successfully!!' : 'Vehicle Created Successfully!!');
        } catch (\Throwable $th) {
            return redirect()->route('backend.vehicles.create')->with('error', 'Vehicle Cannot be Create please check the inputs!!');
        }
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load('category');
        return view('backend.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('backend.vehicles.edit', compact('vehicle'), [
            'categories' => Category::get(['id', 'name']),
            'customers' => Customer::get(['id', 'name'])
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'plat_number' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'customer_id' => 'required|exists:customers,id',
            'duration' => 'required|integer|min:1',
        ]);
        try {
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->update($request->except('status') + ['status' => 1]);
            return redirect()->route('backend.vehicles.index')->with('success', 'Vehicle Updated Successfully!!');
        } catch (\Throwable $th) {
            return redirect()->route('backend.vehicles.edit', $id)->with('error', 'Vehicle Cannot be Updated. Please check the inputs!!');
        }
    }

    public function destroy(Vehicle $vehicle)
    {
        // Update slot parkir terkait menjadi available
        foreach ($vehicle->vehicleIns as $vehicleIn) {
            if ($vehicleIn->parking_slot_id) {
                $slot = \App\Models\ParkingSlot::find($vehicleIn->parking_slot_id);
                if ($slot) {
                    $slot->update(['status' => 'available', 'vehicle_in_id' => null]);
                }
            }
        }
        $vehicle->delete();
        return redirect()->route('backend.vehicles.index')->with('success', 'Vehicle Deleted Successfully!!');
    }
}
