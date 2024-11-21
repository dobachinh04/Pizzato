<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $invoiceId = 'INV-' . $request->user_id . '-' . time();
        $orderData = [
            'invoice_id' => $invoiceId,
            'user_id' => $request->user_id,
            'address' => $request->address,
            'grand_total' => $request->grand_total,
            'product_qty' => $request->product_qty,
            'address_id' => $request->address_id,
            'cartItems' => $request->cartItems,
        ];

        Cache::put("orderData:$invoiceId", $orderData, now()->addMinutes(30));

        if ($request->payment_method === 'vnpay') {
            // Gọi hàm tạo thanh toán VNPAY
            $paymentMethod = (new VnpayController)->createPayment($request, $invoiceId);

            if ($paymentMethod->getData()->success) {
                return response()->json([
                    'success' => true,
                    'vnp_Url' => $paymentMethod->getData()->vnp_Url,
                ]);
            }

            return response()->json([
                'error' => 'Không thể tạo yêu cầu thanh toán VNPAY',
            ], 400);
        }

        $order = Order::create([
            'invoice_id' => $invoiceId,
            'user_id' => $request->user_id,
            'address' => $request->address,
            'grand_total' => $request->grand_total,
            'product_qty' => $request->product_qty,
            'address_id' => $request->address_id,
            'order_status' => 'pending',
            'payment_status' => 'paid',
        ]);

        foreach ($request->cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'unit_price' => $item['price'],
                'qty' => $item['quantity'],
                'size' => $item['size'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Đơn hàng đã được tạo thành công!',
        ]);
    }
}
