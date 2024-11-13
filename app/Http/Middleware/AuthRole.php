<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Bạn cần đăng nhập trước');
        }

        // Kiểm tra nếu có vai trò yêu cầu và người dùng không có vai trò đó
        if ($role && Auth::user()->role !== $role) {
            // Chuyển hướng hoặc trả về thông báo lỗi tùy thuộc vào yêu cầu của bạn
            return redirect()->with('error', 'Bạn không có quyền truy cập trang này'); // hoặc trả về 403 nếu không có quyền
        }

        return $next($request);
    }
}
