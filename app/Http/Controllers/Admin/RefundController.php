<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefundRequest;

class RefundController extends Controller
{
    public function index()
    {
        $refunds = RefundRequest::latest()->paginate(10);
        return view('admin.refunds.index', compact('refunds'));
    }

    public function edit($id)
    {
        $refund = RefundRequest::findOrFail($id);
        return view('admin.refunds.edit', compact('refund'));
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'status' => 'required|in:Pending,Approved,Rejected',
        'admin_note' => 'nullable|string',
    ]);

    // Lấy yêu cầu hoàn tiền
    $refund = RefundRequest::findOrFail($id);

    // Cập nhật trạng thái của yêu cầu hoàn tiền
    $refund->update([
        'status' => $validated['status'],
        'admin_note' => $validated['admin_note'],
    ]);

    // Nếu trạng thái là Approved, cập nhật trạng thái của đơn hàng
    if ($validated['status'] === 'Approved') {
        $order = $refund->order; 
        if ($order) {
            $order->update([
                'order_status' => 'Refunded', // Cập nhật trạng thái đơn hàng
            ]);
        }
    }

    return redirect()->route('admin.refunds.index')->with('success', 'Yêu cầu hoàn tiền đã được cập nhật.');
}

    public function destroy($id)
    {
        // Tìm yêu cầu hoàn tiền theo ID và xóa
        $refund = RefundRequest::findOrFail($id);
        $refund->delete();

        // Quay lại danh sách và thông báo thành công
        return redirect()->route('admin.refunds.index')->with('success', 'Refund request deleted successfully!');
    }
}
