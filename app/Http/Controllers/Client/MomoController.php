<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MomoController extends Controller
{
    public function createPayment(Request $request)
    {
        $partnerCode = config('services.momo.partner_code');
        $accessKey = config('services.momo.access_key');
        $secretKey = config('services.momo.secret_key');
        $endpoint = config('services.momo.endpoint');
        $returnUrl = config('services.momo.return_url');
        $notifyUrl = config('services.momo.notify_url');

        $orderId = (string) time();
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->amount;
        $extraData = "";
        $requestId = (string) time();
        $rawHash = "partnerCode={$partnerCode}&accessKey={$accessKey}&requestId={$requestId}&amount={$amount}&orderId={$orderId}&orderInfo={$orderInfo}&returnUrl={$returnUrl}&notifyUrl={$notifyUrl}&extraData={$extraData}";

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $paymentData = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyUrl,
            'extraData' => $extraData,
            'requestType' => 'captureMoMoWallet',

            // 'requestType' => 'payWithMoMoATM',
            // lỗi ko tìm thấy URL
            // chịu ko biết fix sao :v
            'signature' => $signature,
        ];

        $response = Http::post($endpoint, $paymentData);

        $payUrl = $response['payUrl'] ?? null;
        if (empty($payUrl)) {
            return redirect()->back()->with('error', 'Không thể tạo liên kết thanh toán MoMo. Vui lòng thử lại sau.');
        }

        return redirect()->away($payUrl);
    }


    public function callback(Request $request)
    {
        $inputData = $request->all();
        $secretKey = config('services.momo.secret_key');

        $signature = $inputData['signature'];
        unset($inputData['signature']);

        ksort($inputData);
        $rawHash = urldecode(http_build_query($inputData));

        $generatedSignature = hash_hmac("sha256", $rawHash, $secretKey);

        if ($generatedSignature === $signature && $inputData['resultCode'] === '0') {
            return "Payment successful!";
        }

        return "Payment failed!";
    }
}
