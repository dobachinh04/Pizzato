<?php

namespace App\Providers;

use Carbon\Carbon;
// use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     // Sử dụng view composer để truyền biến $notifications
    //     View::composer('admin.layouts.header', function ($view) {
    //         // $notifications = Auth::check() ? Auth::user()->unreadNotifications : collect();

    //         $notifications = DB::table('notifications')
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    //         $view->with('notifications', $notifications);
    //     });
    // }

    public function boot()
{
    View::composer('admin.layouts.header', function ($view) {
        // Lấy thông báo chưa đọc, chưa xóa mềm, và sắp xếp theo thời gian
        $notifications = DB::table('notifications')
            ->where('type', 'order_overdue')
            ->where('is_read', false)
            ->whereNull('deleted_at') // Bỏ qua thông báo bị xóa mềm
            ->orderBy('created_at', 'desc')
            ->get();

        // Tính toán `time_ago` cho từng thông báo
        $notifications->transform(function ($notification) {
            $notification->time_ago = Carbon::parse($notification->created_at)->diffForHumans();
            return $notification;
        });

        // Đếm số lượng thông báo chưa đọc và chưa bị xóa mềm
        $alertCount = $notifications->count();

        // Truyền dữ liệu sang view
        $view->with([
            'notifications' => $notifications,
            'alertCount' => $alertCount,
        ]);
    });
}
}
// View::composer('admin.layouts.header', function ($view) {
        //     $pendingOrders = DB::table('orders')
        //         ->where('order_status', 'pending')
        //         ->where('created_at', '<=', Carbon::now()->subMinutes(20))
        //         ->get();

        //     foreach ($pendingOrders as $order) {
        //         $order->time_ago = Carbon::parse($order->created_at)->diffForHumans();
        //     }

        //     $view->with('pendingOrders', $pendingOrders);
        //     $view->with('alertCount', $pendingOrders->count());
        // });
