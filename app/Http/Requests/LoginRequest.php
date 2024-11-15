<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email phải đúng định dạng',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            // 'password.min' => 'Mật khẩu dài ít nhất 8 ký tự',
            // 'password.max' => 'Mật khẩu không được vượt quá 16 ký tự',
        ];
    }
}
