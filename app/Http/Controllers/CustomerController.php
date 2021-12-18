<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;

class CustomerController extends Controller
{
    function show()
    {
        return customer::all();
    }
    function getCustomer(Customer $customer)
    {
        return $customer;
    }
    function createCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phonenumber' => 'required'

        ]);
        $customer = customer::create($request->all());
        return response()->json($customer, 202);
    }
    function updateCustomer(Request $request, $customer)
    {
        $customer->update($request->all());
        return response()->json($customer, 200);
    }
    public function deleteCustomer(customer $customer)
    {
        $customer->delete();
        return response()->json(null, 204);
    }
}
