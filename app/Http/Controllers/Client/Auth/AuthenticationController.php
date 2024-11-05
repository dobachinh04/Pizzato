<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    // public function displayLogin()
    // {
    //     return view('auth.login');
    // }

    // public function displayRegister()
    // {
    //     $roles = Role::all();
    //     return view('auth.register', compact('roles'));
    // }

    public function login(Request $request)
    {
        
        $credentials = $request->only('user', 'password');

    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Mặc định vai trò là User (ID là 1)
        $userRoleId = 1;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $userRoleId, // Gán vai trò mặc định là User
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đăng kí thành công',
        ]);
    }


    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
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















