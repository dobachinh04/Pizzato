<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Kiểm tra xem người dùng đã đăng nhập chưa
       if (!Auth::check()) {
        return redirect()->route('client.login')->withErrors(['email' => 'Bạn cần đăng nhập để truy cập trang này.']);
    }

    // Kiểm tra vai trò của người dùng
    $user = Auth::user();
    if ($user->role_id !== 2) { // Giả sử 2 là ID của Admin
        return redirect()->route('client.login')->withErrors(['email' => 'Bạn không có quyền truy cập trang này.']);
    }
        return $next($request);
    }
}
