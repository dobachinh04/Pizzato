<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VnpayController extends Controller
{
    public function createPayment(Request $request)
    {
        $vnp_TmnCode = config('services.vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('services.vnpay.vnp_HashSecret');
        $vnp_Url = config('services.vnpay.vnp_Url');
        $vnp_Returnurl = config('services.vnpay.vnp_ReturnUrl');
        $vnp_TxnRef = time(); // Mã đơn hàng, tạo ngẫu nhiên hoặc lấy từ hệ thống
        $vnp_OrderInfo = "Thanh toan don hang"; // Thông tin đơn hàng
        $vnp_Amount = $request->amount * 100; // Số tiền thanh toán
        $vnp_Locale = 'vn'; // Ngôn ngữ, 'vn' cho tiếng Việt
        $vnp_IpAddr = $request->ip();

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

        // Tạo URL thanh toán với checksum
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

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
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
