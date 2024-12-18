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
            $address = Address::where('user_id', $user->id)->get();
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
        $validator = Validator::make(
            $request->all(),
            [
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
            ]
        );

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

    public function updateUser(Request $request, String $id)
    {
        $user = User::find($id);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatars', $filename);
            $user->avatar = $filename;
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->has('changePassword') && $request->changePassword) {
            $data['password'] = bcrypt($request->password);
        }

        if (isset($filename)) {
            $data['avatar'] = $filename;
        }

        $user->update($data);
    }
}
