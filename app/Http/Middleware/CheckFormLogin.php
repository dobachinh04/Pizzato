<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckFormLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu người dùng đã đăng nhập và đang cố gắng truy cập bất kỳ URL nào của trang đăng nhập
        // if ($request->is('admin/auth/login') || $request->routeIs('admin.login')) {
        //     return redirect()->route('admin.dashboard')->with('message', 'Bạn đã đăng nhập');
        // }
        if (Auth::check()) {
            // Nếu đã đăng nhập, chuyển hướng về trang dashboard hoặc trang chủ
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
