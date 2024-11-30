<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotifyDelayOrderRequest extends FormRequest
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
            'message' => 'required|string|max:255',  // Xác thực message (reason)
            'message_custom' => 'required|string|max:255', // Đảm bảo message_custom hợp lệ khi chọn "Khác"
            'solution' => 'required|string|max:255', // Xác thực solution
            'solution_custom' => 'required|string|max:255', // Đảm bảo solution_custom hợp lệ khi chọn "Khác"
        ];
    }
    public function messages()
    {
        return [
            'message.required' => 'Bạn cần chọn một nội dung thông báo.',
            'message_custom.required' => 'Vui lòng nhập nội dung thông báo khi chọn "Khác".',
            'solution.required' => 'Bạn cần chọn hoặc nhập cách giải quyết.',
            'solution_custom.required' => 'Vui lòng nhập cách giải quyết khi chọn "Khác".',
        ];
    }
}
