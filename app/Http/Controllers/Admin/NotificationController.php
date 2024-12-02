<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        // $notifications = DB::table('notifications')->orderBy('created_at', 'desc')->get();
        // Truyền thông báo sang view
        $pendingOrders = DB::table('orders')
            ->where('order_status', 'pending')
            ->where('created_at', '<=', Carbon::now()->subMinutes(30))
            ->get();

        foreach ($pendingOrders as $order) {
            $order->time_ago = Carbon::parse($order->created_at)->diffForHumans();
        }

        return view('admin.notifications.index', compact('pendingOrders'));
    }


    public function markAsRead(Request $request)
    {
        $notificationIds = $request->input('notification_ids');

        if ($notificationIds) {
            DB::table('notifications')
                ->whereIn('id', $notificationIds)
                ->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }

    // public function delete(Request $request)
    // {
    //     $ids = $request->input('ids', []);

    //     if (!empty($ids)) {
    //         // Xoá thông báo theo ID
    //         // $deletedCount = DB::table('notifications')->whereIn('id', $ids)->delete();
    //         $deletedCount = DB::table('notifications')
    //         ->whereIn('id', $ids)
    //         ->update(['deleted_at' => now()]); // Xóa mềm bằng cách cập nhật deleted_at
    //         return response()->json([
    //             'success' => true,
    //             'message' => "{$deletedCount} notifications deleted successfully!",
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => false,
    //         'message' => 'No notifications selected!',
    //     ]);
    // }

    public function deleteNotifications(Request $request)
{
    $ids = json_decode($request->input('ids'), true);

    if (!empty($ids)) {
        $deletedCount = DB::table('notifications')
            ->whereIn('id', $ids)
            ->whereNull('deleted_at')
            ->update(['deleted_at' => now()]);

        return response()->json([
            'status' => 'success',
            'message' => 'Thông báo đã được xóa.',
            'deleted_count' => $deletedCount,
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Không có thông báo nào được chọn.',
    ]);
}

}
