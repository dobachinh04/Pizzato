<?php

namespace App\Http\Controllers\Client\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    // Code mới nhé
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $address = Address::where('user_id', $user->id)->first();
            return response()->json([
                'message' => 'Đăng nhập thành công',
                'user' => $user,
                'address' => $address
            ], 200);
        } else {
            return response()->json([
                'message' => 'Tài khoản hoặc mật khẩu không hợp lệ!'
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],
        [
            'name.required' => 'Vui lòng nhập tên tài khoản!',
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email nây đã tồn tại!',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.min' => 'Mật khẻu tối thiểu 6 ký tự!',
            'password.confirmed' => 'Mật khẩu xác nhận không khóp!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi khi đăng ký. Vui lòng xem lại!',
                'errors' => $validator->errors(),
            ], 422);
        }

        $role = 1;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đăng kí thành công',
        ]);
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















