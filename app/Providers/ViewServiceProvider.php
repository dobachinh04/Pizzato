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
        $pendingOrders = DB::table('orders')
            ->where('order_status', 'pending')
            ->where('created_at', '<=', Carbon::now()->subMinutes(30))
            ->get();

        foreach ($pendingOrders as $order) {
            $order->time_ago = Carbon::parse($order->created_at)->diffForHumans();
        }

        $view->with('pendingOrders', $pendingOrders);
        $view->with('alertCount', $pendingOrders->count());
    });
}
}
