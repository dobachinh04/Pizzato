<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            // Nếu đã đăng nhập, chuyển hướng về trang dashboard hoặc trang chủ
            return redirect()->route('admin.dashboard')->with('message', 'Bạn đã đăng nhập');
        }
       
        return response()
            ->view('admin.auth.login')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function login(LoginRequest $request)
    {
        // echo 1; die();

        // Lấy thông tin đăng nhập từ request
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        // dd($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Kiểm tra quyền truy cập
            if (Auth::user()->role->name !== 'admin') {
                Auth::logout(); // Đăng xuất người dùng
                // ko quyền
                return redirect()->route('403Page')->with('error', 'Bạn không có quyền truy cập trang này');
                }
                // có quyền
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
        }
        return back()->with('error', 'Email hoặc mật khẩu không chính xác');
    }

    public function logout(Request $request)
    {
        if (Auth::id() == null) {
            return redirect()->route('admin.login')->with('error', 'Bạn chưa đăng nhập');
        }
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Dang xuat thanh cong');
    }

    public function showFormPassword()

    {
        // if (Auth::id() > 0) {
        //     return redirect()->route('admin.dashboard');
        // }
        return view('admin.auth.locksreen');
    }
}
