<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
    public function boot(): void
    {
        // Sử dụng view composer để truyền biến $notifications
        View::composer('admin.layouts.header', function ($view) {
            $notifications = Auth::check() ? Auth::user()->unreadNotifications : collect();
            $view->with('notifications', $notifications);
        });
    }
}
