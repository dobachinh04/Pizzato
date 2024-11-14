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
        if (Auth::id() > 0) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }
    public function showFormPassword()

    {
        // if (Auth::id() > 0) {
        //     return redirect()->route('admin.dashboard');
        // }
        return view('admin.auth.locksreen');
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

}
