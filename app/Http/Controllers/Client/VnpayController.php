<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
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

        // Kiểm tra xem chữ ký có hợp lệ không
        if ($secureHash == $vnp_SecureHash) {
            // Kiểm tra mã phản hồi từ VNPAY
            if ($inputData['vnp_ResponseCode'] == '00') {
                $invoiceId = $inputData['vnp_TxnRef'];

                $orderData = Cache::get("orderData:$invoiceId");

                if (!$orderData) {
                    return response()->json([
                        'error' => 'Không tìm thấy thông tin đơn hàng tạm thời!',
                    ], 400);
                }

                // Lưu đơn hàng vào database
                $order = Order::create([
                    'invoice_id' => $orderData['invoice_id'],
                    'user_id' => $orderData['user_id'],
                    'address' => $orderData['address'],
                    'sub_total' => $orderData['sub_total'],
                    'grand_total' => $orderData['grand_total'],
                    'product_qty' => $orderData['product_qty'],
                    'address_id' => $orderData['address_id'],
                    'order_status' => 'pending',
                    'payment_status' => 'paid',
                ]);

                // Lưu chi tiết đơn hàng
                foreach ($orderData['cartItems'] as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'unit_price' => $item['price'],
                        'qty' => $item['quantity'],
                        'size' => $item['size'],
                    ]);
                }

                return redirect()->away('http://127.0.0.1:3000/payment-successed');
            } else {
                return redirect()->away('http://127.0.0.1:3000/payment-failed');
            }
        } else {
            return response()->json([
                'error' => 'Chữ ký không hợp lệ!',
            ], 400);
        }
    }
}
