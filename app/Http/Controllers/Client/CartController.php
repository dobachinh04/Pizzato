<?php

namespace App\Http\Controllers\Client;

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
    return view('client.carts.giohang', compact('carts'));
}


    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->grand_total = $cart->product->price * $cart->quantity;
        $cart->save();

        return redirect()->route('client.carts.giohang')->with('success', 'Giỏ hàng đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::findOrFail($id);


    $cart->delete();

    return redirect()->route('client.carts.giohang')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
    public function destroyAll()
{
    $userId = auth()->id();
    Cart::where('user_id', $userId)->delete();

    return redirect()->route('client.carts.giohang')->with('success', 'Đã xóa tất cả sản phẩm trong giỏ hàng.');
}
}
