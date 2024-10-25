<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::get();
        // dd($carts);
    return view('admin.carts.giohang', compact('carts'));
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
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->grand_total = $cart->product->price * $cart->quantity;
        $cart->save();

        return redirect()->route('admin.carts.giohang')->with('success', 'Giỏ hàng đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::findOrFail($id);
    
   
    $cart->delete();

    return redirect()->route('admin.carts.giohang')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
    public function destroyAll()
{
    $userId = auth()->id(); // Lấy ID người dùng hiện tại
    Cart::where('user_id', $userId)->delete(); // Xóa tất cả giỏ hàng của người dùng

    return redirect()->route('admin.carts.giohang')->with('success', 'Đã xóa tất cả sản phẩm trong giỏ hàng.');
}
}
