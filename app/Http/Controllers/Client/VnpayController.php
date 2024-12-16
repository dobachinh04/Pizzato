<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class VnpayController extends Controller
{
    public function createPayment(Request $request, $invoiceId)
    {
        // Lấy các cấu hình từ file config
        $vnp_TmnCode = Config::get('services.vnpay.vnp_TmnCode');
        $vnp_HashSecret = Config::get('services.vnpay.vnp_HashSecret');
        $vnp_Url = Config::get('services.vnpay.vnp_Url');
        $vnp_Returnurl = Config::get('services.vnpay.vnp_ReturnUrl');

        $vnp_TxnRef = $invoiceId; // Mã đơn hàng duy nhất
        $vnp_Amount = $request->grand_total * 100; // Tổng tiền chuyển thành VND (1 VND = 100 đồng)
        $vnp_OrderInfo = "Thanh toán cho đơn hàng #" . $invoiceId;
        $vnp_Locale = 'vn'; // Ngôn ngữ: 'vn' cho tiếng Việt
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        // Tạo mảng dữ liệu cho yêu cầu thanh toán
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        // Sắp xếp các tham số theo thứ tự từ điển
        ksort($inputData);

        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Tạo URL thanh toán
        $vnp_Url = $vnp_Url . "?" . rtrim($query, '&');

        // Tạo checksum (hash) và thêm vào URL
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= '&vnp_SecureHash=' . $vnpSecureHash;
        }

        // Trả về URL thanh toán
        return response()->json([
            'success' => true,
            'vnp_Url' => $vnp_Url,
        ]);
    }


    public function callback(Request $request)
    {
        // Lấy các tham số từ URL callback
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'];

        // Xóa tham số 'vnp_SecureHash' và 'vnp_SecureHashType' khỏi mảng dữ liệu vì chúng không tham gia vào tính toán chữ ký
        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        // Sắp xếp các tham số theo thứ tự từ điển
        ksort($inputData);

        // Tạo chuỗi hash từ các tham số
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');

        // Lấy khóa bảo mật từ config
        $vnp_HashSecret = config('services.vnpay.vnp_HashSecret');

        // Tạo hash với hmac sha512
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash != $vnp_SecureHash) {
            return response()->json([
                'error' => 'Chữ ký không hợp lệ!',
            ], 400);
        }

        // Kiểm tra mã phản hồi từ VNPAY
        if ($inputData['vnp_ResponseCode'] !== '00') {
            return redirect()->away('http://127.0.0.1:3000/payment-failed');
        }

        // Lấy `invoiceId` từ callback
        $invoiceId = $inputData['vnp_TxnRef'];

        // Sử dụng Lock để đảm bảo callback chỉ xử lý một lần
        $lock = Cache::lock("orderCallbackLock:$invoiceId", 30); // Thời gian khóa 30 giây

        if ($lock->get()) {
            try {
                $orderData = Cache::get("orderData:$invoiceId");

                if (!$orderData) {
                    return response()->json([
                        'error' => 'Không tìm thấy thông tin đơn hàng tạm thời!',
                    ], 400);
                }

                // Kiểm tra xem đơn hàng đã được xử lý chưa
                $existingOrder = Order::where('invoice_id', $invoiceId)->first();
                if ($existingOrder) {
                    return redirect()->away('http://127.0.0.1:3000/payment-successed');
                }

                DB::transaction(function () use ($request, $orderData) {
                    $order = Order::create([
                        'invoice_id' => $orderData['invoice_id'],
                        'user_id' => $orderData['user_id'],
                        'address' => $orderData['address'],
                        'sub_total' => $orderData['sub_total'],
                        'grand_total' => $orderData['grand_total'],
                        'product_qty' => $orderData['product_qty'],
                        'address_id' => $orderData['address_id'],
                        'discount' => $orderData['discount'],
                        'order_status' => 'pending',
                        'payment_status' => 'paid',
                        'payment_method' => $orderData['payment_method'],
                        'delivery_charge' => $orderData['delivery_charge'],
                        'coupon_info' => $orderData['coupon_info'],
                    ]);

                    if (!empty($request->coupon_info)) {
                        // Giải mã JSON nếu coupon_info lưu dưới dạng JSON
                        $couponData = json_decode($request->coupon_info, true);
                        $couponCode = $couponData['code'] ?? null;

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

                    foreach ($orderData['cartItems'] as $item) {
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

                Cache::forget("orderData:$invoiceId");

                return redirect()->away('http://127.0.0.1:3000/payment-successed');
            } finally {
                $lock->release();
            }
        } else {
            // Nếu không lấy được Lock, báo lỗi trùng lặp
            return response()->json([
                'error' => 'Đơn hàng đang được xử lý bởi một tiến trình khác. Vui lòng thử lại sau.',
            ], 429);
        }
    }
}
