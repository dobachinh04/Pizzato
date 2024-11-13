<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class VnpayController extends Controller
{
    public function createPayment(Request $request)
    {
        // Lấy các cấu hình từ file config
        $vnp_TmnCode = Config::get('services.vnpay.vnp_TmnCode');
        $vnp_HashSecret = Config::get('services.vnpay.vnp_HashSecret');
        $vnp_Url = Config::get('services.vnpay.vnp_Url');
        $vnp_Returnurl = Config::get('services.vnpay.vnp_ReturnUrl');
        // $timer = config('services.vnpay.timer');

        // Sử dụng invoice_id làm vnp_TxnRef, đây là mã đơn hàng của bạn
        $vnp_TxnRef = random_int(100000, 999999); // Mã đơn hàng duy nhất
        $vnp_Amount = $request->grand_total * 100; // Tổng tiền chuyển thành VND (1 VND = 100 đồng)
        $vnp_OrderInfo = "Thanh toán cho đơn hàng #" . $vnp_TxnRef;
        $vnp_Locale = 'vn'; // Ngôn ngữ: 'vn' cho tiếng Việt
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $timeCreated = now(); // Hoặc lấy thời gian từ đơn hàng nếu có
        $timeLimit = 30; // 30 giây đếm ngược
        if (now()->diffInSeconds($timeCreated) > $timeLimit) {
            return response()->json([
                'message' => 'Quá thời gian thanh toán. Vui lòng thử lại.'
            ], 400);
        }

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
        $vnp_HashSecret = config('services.vnpay.vnp_HashSecret');
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Thanh toán thành công
                return "Payment success!";
            }
            return "Payment failed!";
        }
        return "Invalid signature!";
    }
}
