<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
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

    public function delete(Request $request)
    {
        $notificationIds = $request->input('ids'); // Danh sách ID cần xóa

        if (!empty($notificationIds)) {
            DB::table('orders')->whereIn('id', $notificationIds)->delete();
            return back()->with('success','Xoá thông báo thành công');
        }

        return back()->with('warning','Không có thông báo nào được chọn');
        ;
    }

}
// public function markAsRead(Request $request)
// {
//     // Đánh dấu tất cả thông báo là đã đọc
//     auth()->user()->unreadNotifications->markAsRead();

//     return redirect()->back()->with('success', 'Tất cả thông báo đã được đánh dấu là đã đọc.');
// }
