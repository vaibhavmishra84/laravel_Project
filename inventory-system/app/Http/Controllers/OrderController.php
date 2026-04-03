<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        // Order save
        $order = Order::create($validated);

        // Python API call (stock reduce)
        $response = Http::post('http://127.0.0.1:8001/inventory/update', [
            'sku' => $validated['sku'],
            'change' => -$validated['quantity']
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Stock update failed'], 500);
        }

        return $order;
    }
    public function index()
{
    return \App\Models\Order::all();
}
}