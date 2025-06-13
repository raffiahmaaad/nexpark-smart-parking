<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{

    public function index()
    {
        return view('backend.customers.index', ['customers' => Customer::all()]);
    }

    public function create()
    {
        return view('backend.customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $data = $request->except('customer_id', 'avatar');
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = 'storage/' . $avatar;
        }
        Customer::updateOrCreate(['id' => $request->customer_id], $data);
        return redirect()->route('backend.customers.index')->with('success', 'Customer Created Successfully!!');
    }


    public function edit(Customer $customer)
    {
        return view('backend.customers.edit', compact('customer'));
    }

    public function update(StoreCustomerRequest $request, Customer $customer)
    {
        $data = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = 'storage/' . $avatar;
        }
        $customer->update($data);
        // Update session avatar jika customer yang sedang login adalah yang diedit
        if (session('customer_id') == $customer->id) {
            session(['customer_avatar' => $customer->avatar]);
        }
        return redirect()->route('backend.customers.index')->with('success', 'Customer Updated Successfully!!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('backend.customers.index')->with('success', 'Customer Deleted Successfully!!');
    }
}
