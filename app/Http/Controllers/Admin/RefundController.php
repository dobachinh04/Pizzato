<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefundRequest;
use Illuminate\Support\Facades\DB;

class RefundController extends Controller
{
    public function index()
    {
        $refunds = RefundRequest::orderBy('created_at', 'desc')->get();
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

    public function updateStatus(Request $request, $id)
    {
        $refund = RefundRequest::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $refund->status = $request->status;
        $refund->save();

        return redirect()->back()->with('success', 'Yêu cầu hoàn tiền đã được cập nhật thành công.');
    }

    public function cancel(RefundRequest $order)
    {
        try {
            DB::beginTransaction();

            // Kiểm tra trạng thái đơn hàng
            if (in_array($order->order_status, ['processing'])) {
                return redirect()->back()->with('error', 'Đơn hàng "Đang Được Giao", không thể hủy.');
            } elseif (in_array($order->order_status, ['completed'])) {
                return redirect()->back()->with('error', 'Đơn hàng "Đã Hoàn Thành", không thể hủy.');
            } elseif (in_array($order->order_status, ['canceled'])) {
                return redirect()->back()->with('error', 'Đơn hàng "Đã Bị Hủy", không thể hủy lần nữa.');
            }

            // Cập nhật trạng thái đơn hàng
            $order->update([
                'order_status' => 'canceled',
                'updated_at' => now(),
            ]);

            // Cập nhật lại stock nếu cần (tuỳ vào nghiệp vụ)
            // foreach ($order->orderItems as $item) {
            //     $item->product->increment('stock', $item->quantity);
            // }

            DB::commit();
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi hủy đơn hàng: ' . $e->getMessage());
        }
    }
}
