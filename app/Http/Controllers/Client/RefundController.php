<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RefundRequestStore;
use Illuminate\Http\Request;
use App\Models\RefundRequest;
use App\Models\Order;

class RefundController extends Controller
{
    public function createRefundRequest(RefundRequestStore $request)
    {
        $refund = RefundRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'invoice_id' => $request->invoice_id,
            'refund_amount' => $request->refund_amount,
            'refund_reason' => $request->refund_reason,
            'bank_number' => $request->bank_number,
            'bank_type' => $request->bank_type,
            'status' => 'pending',
        ]);

        $order = Order::where('invoice_id', $request->invoice_id)->first();
        $order->update(['order_status' => 'canceled']);

        return response()->json([
            'message' => 'Yêu cầu hoàn tiền đã được gửi',
            'data' => $refund,
        ], 201);
    }
}
