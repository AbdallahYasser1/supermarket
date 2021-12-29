<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sales;
use App\Models\product;

class salecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return sales::with('product')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Product::find($product_id);
        if ($quantity > $product->quantity) {
            return response()->json(['message' => 'Invalid quantity'], 202);
        }
        $product->quantity = $product->quantity - $quantity;
        $product->save();
        sales::create([
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $product->price
        ]);
        return response()->json($product, 202);
    }
}
