<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(customer::all(), 200);
    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:customers,email',
            'phone'     => 'required|string|max:20',
            'address'   => 'nullable|string',
        ]);

        $customer = customer::create($data);

        return response()->json($customer, 201);
    }

    public function show(customer $customer)
    {
        return response()->json($customer, 200);
    }

    public function edit(customer $customer) {}

    public function update(Request $request, customer $customer)
    {
        $data = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'email'     => 'sometimes|email|unique:customers,email,' . $customer->id,
            'phone'     => 'sometimes|string|max:20',
            'address'   => 'nullable|string',
        ]);

        $customer->update($data);

        return response()->json($customer, 200);
    }

    public function destroy(customer $customer)
    {
        $customer->delete();

        return response()->json(['message' => 'customer supprimé'], 200);
    }
}