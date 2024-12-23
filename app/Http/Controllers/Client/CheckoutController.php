<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'discount' => $request->discount,
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

        DB::transaction(function () use ($request, $invoiceId) {
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
                'discount' => $request->discount,
                'order_status' => 'pending',
            ]);

            if (!empty($request->coupon_info)) {
                // Giải mã JSON nếu coupon_info lưu dưới dạng JSON
                $couponData = json_decode($request->coupon_info, true);
                $couponCode = $couponData ?? null;

                if ($couponCode) {
                    $coupon = Coupon::where('code', $couponCode)
                        ->where('expire_date', '>=', now())
                        ->where('qty', '>', 0)
                        ->lockForUpdate()
                        ->first();

                    if ($coupon) {
                        $coupon->decrement('qty', 1);
                    } else {
                        throw new \Exception("Mã giảm giá không hợp lệ hoặc đã hết hạn.");
                    }
                } else {
                    throw new \Exception("Mã giảm giá không hợp lệ.");
                }
            }

            foreach ($request->cartItems as $item) {
                $product = Product::where('id', $item['id'])
                    ->where('qty', '>=', $item['quantity'])
                    ->lockForUpdate()
                    ->first();

                if ($product) {
                    $updated = Product::where('id', $item['id'])
                        ->decrement('qty', $item['quantity']);

                    if (!$updated) {
                        throw new \Exception("Sản phẩm {$product->name} đã hết hàng hoặc không đủ số lượng.");
                    }

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'unit_price' => $item['price'],
                        'qty' => $item['quantity'],
                        'product_size' => $item['size'],
                        'pizza_edge' => $item['border'],
                        'pizza_base' => $item['crust'],
                    ]);
                } else {
                    throw new \Exception("Sản phẩm {$item['name']} đã hết hàng.");
                }
            }
        });

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
            'phone' => ['required', 'regex:/^0[0-9]{9}$/'],
            'address' => 'required|string',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'first_name.required' => 'Vui lòng nhập tên',
            'last_name.required' => 'Vui lòng nhập họ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại không hợp lệ',
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

    public function updateAddresses(Request $request, String $id)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'email' => 'required|email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => ['required', 'regex:/^0[0-9]{9}$/'],
            'address' => 'required|string',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'first_name.required' => 'Vui lòng nhập tên',
            'last_name.required' => 'Vui lòng nhập họ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'address.required' => 'Vui lòng nhập thêm thông tin địa chỉ',
        ]);

        $address = Address::find($id);
        $address->update([
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
            'address' => $address
        ]);
    }

    public function deleteAddress(Request $request, String $id)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);

        $address = Address::find($id);
        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa thành công',
        ]);
    }
}
