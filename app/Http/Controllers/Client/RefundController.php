<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefundRequest;
use App\Models\Order;

class RefundController extends Controller
{
    public function create()
    {
        // Lấy danh sách đơn hàng đã hủy của khách hàng
        $orders = Order::where('user_id', auth()->id())->where('status', 'Canceled')->get();
        return view('client.refunds.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:orders,invoice_id',
            'refund_reason' => 'required|string',
            'bank_number' => 'required|string',
            'bank_type' => 'required|string',
        ]);

        RefundRequest::create([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'invoice_id' => $validated['invoice_id'],
            'refund_amount' => Order::where('invoice_id', $validated['invoice_id'])->value('grand_total'),
            'refund_reason' => $validated['refund_reason'],
            'bank_number' => $validated['bank_number'],
            'bank_type' => $validated['bank_type'],
        ]);

        return redirect()->route('client.refunds.index')->with('success', 'Yêu cầu hoàn tiền của bạn đã được gửi.');
    }
}
