<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function index()
    {
        
        $carts = Cart::with('product')->get();
        return view('checkout.index', compact('carts'));
        // // Lấy thông tin sản phẩm từ cart của người dùng
        // $cartItems = Cart::where('user_id', Auth::id())->get();
        
        // // Nếu chưa đăng nhập, người dùng sẽ không thấy thông tin cá nhân
        // $user = Auth::user();

        // return view('checkout.index', compact('cartItems', 'user'));\
    
    }

    public function store(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        // if (!Auth::check()) {
        //     return redirect()->route('client.login')->with('error', 'Bạn cần đăng nhập để thanh toán.');
        // }

        // Validate dữ liệu từ form
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required|string',
        ]);

        // Tính toán tổng tiền và số lượng sản phẩm
        $carts = Cart::where('user_id', Auth::id())->get();
        $grandTotal = $carts->sum('grand_total'); // Tổng tiền
        $productQty = $carts->sum('quantity'); // Tổng số lượng sản phẩm

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

        // Lưu chi tiết đơn hàng
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'unit_price' => $cart->grand_total / $cart->quantity, // Giá đơn vị
                'qty' => $cart->quantity,
            ]);
        }

        // Xóa sản phẩm trong giỏ hàng sau khi đặt hàng
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('checkout.index')->with('success', 'Thanh toán thành công!');
    }
   
}
