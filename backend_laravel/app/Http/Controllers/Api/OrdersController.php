<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return response()->json(Order::with(['product', 'customer'])->get(), 200);
    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id'  => 'required|exists:customers,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::find($data['product_id']);

        $data['total_price'] = $product->price * $data['quantity'];

        $order = Order::create($data);

        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        return response()->json($order->load(['product', 'customer']), 200);
    }

    public function edit(Order $order) {}

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'product_id' => 'sometimes|exists:products,id',
            'customer_id'  => 'sometimes|exists:customers,id',
            'quantity'   => 'sometimes|integer|min:1',
        ]);

        if (isset($data['quantity']) || isset($data['product_id'])) {
            $product_id = $data['product_id'] ?? $order->product_id;
            $quantity   = $data['quantity'] ?? $order->quantity;

            $product = Product::find($product_id);

            $data['total_price'] = $product->price * $quantity;
        }

        $order->update($data);

        return response()->json($order, 200);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'Commande supprimée'], 200);
    }
}