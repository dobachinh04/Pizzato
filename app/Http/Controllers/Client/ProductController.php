<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('show_at_home', 1)
            ->where('status', 1)
            ->get();

        return response()->json([
            'products' => $products,
            'message' => 'success'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->increment('view');

        return view('client.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductController $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, ProductController $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductController $product)
    {
        //
    }
}
