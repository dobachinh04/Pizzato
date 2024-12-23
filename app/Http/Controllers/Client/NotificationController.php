<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function getNotificationByInvoiceId(String $id)
    {
        $notification = DB::table('delay_notifications')
            ->join('orders', 'delay_notifications.invoice_id', '=', 'orders.invoice_id')
            ->where('orders.user_id', $id)
            ->orderBy('created_at', 'desc')
            ->select('delay_notifications.id', 'delay_notifications.invoice_id', 'reason', 'solution', 'delay_notifications.is_read', 'delay_notifications.created_at')
            ->get();

        // Kiểm tra nếu không có thông báo
        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Không có thông báo!',
            ], 404);
        }

        // Trả về thông báo nếu có
        return response()->json([
            'success' => true,
            'notification' => $notification,
        ], 200);
    }

    public function readNotification(String $id)
    {
        DB::table('delay_notifications')
            ->where('id', $id)
            ->update(['is_read' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Thực hành thành công!',
        ], 200);
    }

    public function deleteNotification(String $userId)
    {
        $invoiceIds = DB::table('orders')
            ->where('user_id', $userId)
            ->pluck('invoice_id');

        if ($invoiceIds->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng cho user_id này.',
            ], 404);
        }

        DB::table('delay_notifications')
        ->whereIn('invoice_id', $invoiceIds)
        ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa thành công!',
        ], 200);
    }
}
