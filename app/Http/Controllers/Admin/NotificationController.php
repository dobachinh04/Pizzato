<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = DB::table('notifications')->orderBy('created_at', 'desc')->get();
        // Truyền thông báo sang view
        return view('admin.layouts.header', compact('notifications'));
    }

}
// public function markAsRead(Request $request)
// {
//     // Đánh dấu tất cả thông báo là đã đọc
//     auth()->user()->unreadNotifications->markAsRead();

//     return redirect()->back()->with('success', 'Tất cả thông báo đã được đánh dấu là đã đọc.');
// }
