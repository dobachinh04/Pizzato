<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Trả về danh sách sản phẩm trong giỏ hàng của người dùng
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return response()->json([
            'success' => true,
            'data' => $carts
        ]);
    }

    // Xác nhận và lưu đơn hàng
    public function store(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        // if (!Auth::check()) {
        //     return response()->json(['error' => 'Bạn cần đăng nhập để thanh toán.'], 401);
        // }

        // Validate dữ liệu từ request
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required|string',
        ]);

        // Lấy giỏ hàng của người dùng và tính tổng tiền, số lượng sản phẩm
        $carts = Cart::where('user_id', Auth::id())->get();
        $grandTotal = $carts->sum('grand_total');
        $productQty = $carts->sum('quantity');

        // Tạo đơn hàng
        $order = Order::create([
            'invoice_id' => uniqid(),
            'user_id' => Auth::id(),
            'address_id' => $request->address_id,
            'grand_total' => $grandTotal,
            'product_qty' => $productQty,
            'payment_method' => $request->payment_method,
            'order_status' => 'pending',
        ]);

        // Lưu các sản phẩm trong chi tiết đơn hàng
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'unit_price' => $cart->grand_total / $cart->quantity,
                'qty' => $cart->quantity,
            ]);
        }

        // Xóa giỏ hàng sau khi hoàn tất thanh toán
        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Thanh toán thành công!',
            'order_id' => $order->id,
        ]);
    }
}
