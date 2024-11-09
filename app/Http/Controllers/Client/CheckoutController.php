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

        // Validate dữ liệu từ request
        // $request->validate([
        //     'address_id' => 'required|exists:addresses,id',
        //     'payment_method' => 'required|string',
        // ]);

        // Lấy giỏ hàng của người dùng và tính tổng tiền, số lượng sản phẩm
        // $carts = Cart::where('user_id', Auth::id())->get();
        // $grandTotal = $carts->sum('grand_total');
        // $productQty = $carts->sum('quantity');


        // Tạo đơn hàng
        $order = Order::create([
            'invoice_id' => uniqid(),
            'user_id' => $request->user_id,
            'address' => $request->address,
            'grand_total' => $request->grand_total,
            'product_qty' => $request->product_qty,
            'address_id' => $request->address_id,
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

        // Lưu các sản phẩm trong chi tiết đơn hàng
        foreach ($request->cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'unit_price' => $item['price'],
                'qty' => $item['quantity'],
                'size' => $item['size'],
            ]);
        }

        // Xóa giỏ hàng sau khi hoàn tất thanh toán
        // Cart::where('user_id', Auth::id())->delete();
        if ($request->payment_method === 'vnpay') {
            // Nếu người dùng chọn VNPAY, thực hiện thanh toán qua VNPAY
            return (new VnpayController)->createPayment($request);
        }

        return response()->json([
            'success' => true,
            'message' => 'Thanh toán thành công!',
        ]);

    }

}
