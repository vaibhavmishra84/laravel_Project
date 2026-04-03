<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Http;

class APIProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }



public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required',
        'sku' => 'required|unique:products',
        'price' => 'required|numeric',
        'quantity' => 'required|integer'
    ]);

    $product = Product::create($validated);

    // Python API call
    Http::post('http://127.0.0.1:8001/inventory/update', [
        'sku' => $validated['sku'],
        'change' => 0
    ]);

    return $product;
}
}