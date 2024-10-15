<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User; // Nếu bạn sử dụng model User
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        // 'role_id' => 'required|integer', // Đảm bảo có kiểm tra cho role_id
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role_id, // Thêm role_id
    ]);

    return redirect()->route('client.login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
}

}
