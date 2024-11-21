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

        $refund = RefundRequest::findOrFail($id);
        $refund->update([
            'status' => $validated['status'],
            'admin_note' => $validated['admin_note'],
        ]);

        return redirect()->route('admin.refunds.index')->with('success', 'Yêu cầu hoàn tiền đã được cập nhật.');
    }
}
