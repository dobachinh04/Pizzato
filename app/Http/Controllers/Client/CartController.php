<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    public function addToCart(CartRequest $request)
    {
        try {
            $validated = $request->validated();

            // Kiểm tra sản phẩm có tồn tại không
            $product = Product::findOrFail($validated['product_id']);

            // Tạo mới trong giỏ hàng
            $cartItem = Cart::create([
                'product_id' => $product->id,
                'price' => $product->price, // Lấy giá từ product
                'qty' => $validated['qty'],
                'product_size' => $validated['product_size'],
                'pizza_edge' => $validated['pizza_edge'],
                'pizza_base' => $validated['pizza_base'],
            ]);

            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng', 'cart' => $cartItem], 201);
        } catch (\Exception $e) {

            \Log::error($e->getMessage());
            return response()->json(['error' => 'Có lỗi gì đó', 'details' => $e->getMessage()], 500);
        }
    }
    public function viewCart()
    {
        $cartItems = Cart::with('product')->get();

        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->qty;
        });

        return response()->json(['cart' => $cartItems, 'total' => $total]);
    }

    public function updateCart(UpdateCartRequest $request, $id)
    {
        $validated = $request->validated();

        $cartItem = Cart::findOrFail($id);
        $cartItem->update(['qty' => $validated['qty']]);

        return response()->json(['message' => 'Đã cập nhật giỏ hàng', 'cart' => $cartItem]);
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return response()->json(['message' => 'Sản phẩm đã được xoá khỏi giỏ hàng']);
    }

    // Xóa all cart
    public function clearCart()
    {
        Cart::truncate(); // Xóa toàn bộ bản ghi
        return response()->json(['message' => 'Xoá giỏ hàng thành công']);
    }
}
