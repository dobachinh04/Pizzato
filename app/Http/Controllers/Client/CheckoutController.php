<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $invoiceId = 'INV-' . $request->user_id . '-' . time();

        if (Cache::has("orderData:$invoiceId")) {
            return response()->json([
                'error' => 'Đơn hàng này đã được thanh toán hoặc đang trong quá trình thanh toán.',
            ], 400);
        }

        $orderData = [
            'invoice_id' => $invoiceId,
            'user_id' => $request->user_id,
            'address' => $request->address,
            'sub_total' => $request->sub_total,
            'grand_total' => $request->grand_total,
            'product_qty' => $request->product_qty,
            'address_id' => $request->address_id,
            'payment_method' => $request->payment_method,
            'delivery_charge' => $request->delivery_charge,
            'coupon_info' => $request->coupon_info,
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
            'sub_total' => $request->sub_total,
            'grand_total' => $request->grand_total,
            'product_qty' => $request->product_qty,
            'address_id' => $request->address_id,
            'payment_method' => 'cash',
            'delivery_charge' => $request->delivery_charge,
            'coupon_info' => $request->coupon_info,
            'order_status' => 'pending',
        ]);

        foreach ($request->cartItems as $item) {
            // Lock the product record for update
            $product = Product::where('id', $item['id'])
                              ->where('qty', '>=', $item['quantity'])
                              ->lockForUpdate()  // Lock the record to avoid race condition
                              ->first();

            if ($product) {
                $updated = Product::where('id', $item['id'])
                    ->decrement('qty', $item['quantity']);

                if (!$updated) {
                    return response()->json([
                        'success' => false,
                        'message' => "Sản phẩm {$product->name} đã hết hàng hoặc không đủ số lượng.",
                    ], 400);
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'unit_price' => $item['price'],
                    'qty' => $item['quantity'],
                    'size' => $item['size'],
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Sản phẩm {$item['name']} đã hết hàng.",
                ], 400);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Đơn hàng đã được tạo thành công!',
        ]);
    }

    public function getDeliveryArea(Request $request)
    {
        $deliveryArea = DeliveryArea::all();
        return response()->json([
            'success' => true,
            'delivery_area' => $deliveryArea,
        ]);
    }

    public function addToAddress(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'first_name.required' => 'Vui lòng nhập tên',
            'last_name.required' => 'Vui lòng nhập họ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng nhập thêm thông tin địa chỉ',
        ]);

        $address = Address::create([
            'user_id' => $request->user_id,
            'delivery_area_id' => $request->delivery_area_id,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công',
            'addressId' => $address->id
        ]);
    }
}
