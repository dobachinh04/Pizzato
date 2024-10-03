<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // Họ và Tên: bắt buộc, kiểu chuỗi, tối đa 255 ký tự
            'email' => 'required|email|unique:users,email', // Email: bắt buộc, định dạng email, duy nhất trong bảng users
            'password' => 'required|string|min:6|confirmed', // Mật Khẩu: bắt buộc, tối thiểu 6 ký tự, xác nhận mật khẩu
            'password_confirmation' => 'required|string|min:6|confirmed', // Mật Khẩu: bắt buộc, tối thiểu 6 ký tự, xác nhận mật khẩu
            'role_id' => 'required|exists:roles,id', // Vai trò: bắt buộc và phải tồn tại trong bảng roles

            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ảnh: không bắt buộc, định dạng ảnh, tối đa 2MB
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Họ và Tên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password_confirmation.required' => 'Mật khẩu là bắt buộc.',
            'role_id.required' => 'Vui lòng chọn vai trò.',
            'role_id.exists' => 'Vai trò không tồn tại.',
            'image.required' => 'Ảnh là bắt buộc.',
            'image.image' => 'Tập tin phải là ảnh.',
            'image.mimes' => 'Chỉ hỗ trợ định dạng jpeg, png, jpg, gif.',
            'image.max' => 'Ảnh tối đa 2MB.',
        ];
    }
}
