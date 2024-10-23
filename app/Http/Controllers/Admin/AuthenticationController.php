<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User; // Nếu bạn sử dụng model User
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
class AuthenticationController extends Controller
{
    public function displayLogin()
    {
        return view('auth.login'); // Tạo view cho đăng nhập
    }

    public function displayRegister()
    {
        $roles = Role::all(); // Lấy tất cả vai trò từ bảng roles
        return view('auth.register', compact('roles')); // Truyền biến $roles vào view

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/admin/dashboard'); // Chuyển hướng đến trang dashboard
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không đúng.',
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Mặc định vai trò là User (ID là 1)
        $userRoleId = 2; // Thay đổi ID nếu cần
    
        // Tạo người dùng với vai trò mặc định là User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $userRoleId,
        ]);
    
        return redirect()->route('client.login')->with('status', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
    


    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password'); // View cho trang đặt lại mật khẩu
    }

    public function resetPassword(Request $request)
    {
        // Validate thông tin người dùng nhập
        $request->validate([
            'email' => 'required|email|exists:users,email', // Kiểm tra email có tồn tại trong hệ thống
            'password' => 'required|string|min:8|confirmed', // Kiểm tra mật khẩu hợp lệ và khớp với mật khẩu xác nhận
        ]);

        // Tìm người dùng theo email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Đặt lại mật khẩu cho người dùng
            $user->update([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60), // Cập nhật token mới để đảm bảo bảo mật
            ]);

            return redirect()->route('client.login')->with('status', 'Mật khẩu của bạn đã được đặt lại thành công. Vui lòng đăng nhập.');
        }

        // Trường hợp không tìm thấy người dùng
        return back()->withErrors(['email' => 'Không tìm thấy người dùng với email này.']);
    }
}
