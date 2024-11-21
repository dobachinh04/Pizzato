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
        $orders = Order::where('user_id', auth()->id())->where('order_status', 'Canceled')->get();
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
    
        // Lưu yêu cầu hoàn tiền vào bảng refund_requests
        RefundRequest::create([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'invoice_id' => $validated['invoice_id'],
            'refund_amount' => Order::where('invoice_id', $validated['invoice_id'])->value('grand_total'),
            'refund_reason' => $validated['refund_reason'],
            'bank_number' => $validated['bank_number'],
            'bank_type' => $validated['bank_type'],
        ]);
    
        // Sau khi gửi yêu cầu, chuyển hướng đến trang quản lý hoàn tiền của admin
        return redirect()->route('admin.refunds.index')->with('success', 'Yêu cầu hoàn tiền đã được gửi.');
    }
    
}
