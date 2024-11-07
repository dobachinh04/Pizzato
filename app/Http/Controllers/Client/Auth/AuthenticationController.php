<?php

namespace App\Http\Controllers\Client\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'message' => 'Đăng nhập thành công',
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'error' => 'Tài khoản hoặc mật khẩu không hợp lệ!'
            ], 401);
        }
    }

    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6|confirmed', // Đảm bảo mật khẩu được xác nhận
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => 'Validation Error',
        //         'errors' => $validator->errors(),
        //     ], 422);
        // }

        $role = 1;

        // Nếu xác thực thành công, bạn có thể tiếp tục với logic để tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role,
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ]);

            return redirect()->route('client.login')->with('status', 'Mật khẩu của bạn đã được đặt lại thành công. Vui lòng đăng nhập.');
        }

        return back()->withErrors(['email' => 'Không tìm thấy người dùng với email này.']);
    }
}
