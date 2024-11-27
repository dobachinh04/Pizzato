<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RefundRequestStore;
use Illuminate\Http\Request;
use App\Models\RefundRequest;
use App\Models\Order;

class RefundController extends Controller
{
    // public function create()
    // {
    //     // Lấy danh sách đơn hàng đã hủy của khách hàng
    //     $orders = Order::where('user_id', auth()->id())->where('order_status', 'Canceled')->get();
    //     return view('client.refunds.create', compact('orders'));
    // }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'invoice_id' => 'required|exists:orders,invoice_id',
    //         'refund_reason' => 'required|string',
    //         'bank_number' => 'required|string',
    //         'bank_type' => 'required|string',
    //     ]);

    //     // Lưu yêu cầu hoàn tiền vào bảng refund_requests
    //     RefundRequest::create([
    //         'name' => auth()->user()->name,
    //         'email' => auth()->user()->email,
    //         'invoice_id' => $validated['invoice_id'],
    //         'refund_amount' => Order::where('invoice_id', $validated['invoice_id'])->value('grand_total'),
    //         'refund_reason' => $validated['refund_reason'],
    //         'bank_number' => $validated['bank_number'],
    //         'bank_type' => $validated['bank_type'],
    //     ]);

    //     // Sau khi gửi yêu cầu, chuyển hướng đến trang quản lý hoàn tiền của admin
    //     return redirect()->route('admin.refunds.index')->with('success', 'Yêu cầu hoàn tiền đã được gửi.');
    // }
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
            'status' => 'Đang xử lý',
        ]);

        return response()->json([
            'message' => 'Yêu cầu hoàn tiền đã được gửi ',
            'data' => $refund,
        ], 201);
    }
}
