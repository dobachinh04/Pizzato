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

    }



    // public function boot()
    // {
    //     View::composer('admin.layouts.header', function ($view) {
    //         // Lấy thông báo chưa đọc, chưa xóa mềm, và sắp xếp theo thời gian
    //         $notifications = DB::table('notifications')
    //             ->where('type', 'order_overdue')
    //             ->where('is_read', false)
    //             ->whereNull('deleted_at') // Bỏ qua thông báo bị xóa mềm
    //             ->orderBy('created_at', 'desc')
    //             ->get();

    //         // Tính toán `time_ago` cho từng thông báo
    //         $notifications->transform(function ($notification) {
    //             $notification->time_ago = Carbon::parse($notification->created_at)->diffForHumans();
    //             return $notification;
    //         });

    //         // Lấy thông tin thời gian của đơn hàng dựa trên `reference_id`
    //         foreach ($notifications as $notification) {
    //             // Lấy đơn hàng dựa trên reference_id
    //             $order = DB::table('orders')
    //                 ->where('invoice_id', $notification->reference_id)
    //                 ->first();

    //             if ($order) {
    //                 //  thời gian đơn hàng bao nhiêu phút trước
    //                 $notification->order_time_ago  = Carbon::parse($order->created_at)->diffForHumans();
    //             }
    //         }
    //         // Đếm số lượng thông báo chưa đọc và chưa bị xóa mềm
    //         $alertCount = $notifications->count();

    //         // Truyền dữ liệu sang view
    //         $view->with([
    //             'notifications' => $notifications,
    //             'alertCount' => $alertCount,
    //         ]);
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

        // Kiểm tra và xóa thông báo không còn đơn hàng liên quan
        foreach ($notifications as $key => $notification) {
            $order = DB::table('orders')
                ->where('invoice_id', $notification->reference_id)
                ->first();

            if (!$order) {
                // Nếu đơn hàng không tồn tại, xóa thông báo khỏi database()
                DB::table('notifications')->where('id', $notification->id)->delete();
                unset($notifications[$key]); // Loại bỏ thông báo khỏi danh sách hiện tại
            } else {
                // Nếu đơn hàng tồn tại, tính toán thông tin thêm
                $notification->time_ago = Carbon::parse($notification->created_at)->diffForHumans();
                $notification->order_time_ago = Carbon::parse($order->created_at)->diffForHumans();
            }
        }

        // Đếm số lượng thông báo còn lại
        $alertCount = count($notifications);

        // Truyền dữ liệu sang view
        $view->with([
            'notifications' => $notifications,
            'alertCount' => $alertCount,
        ]);
    });

}
}
