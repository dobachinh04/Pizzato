<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefundRequestStore extends FormRequest
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
            'refund_reason' => 'required|string',
            'bank_number' => 'required|string|max:20',
            'bank_type' => 'required|string|max:50',
        ];
    }

    public function messages(): array
{
    return [
        'refund_reason.required' => 'Lý do hoàn tiền là bắt buộc.',
        'refund_reason.string' => 'Lý do hoàn tiền phải là chuỗi ký tự.',

        'bank_number.required' => 'Số tài khoản ngân hàng là bắt buộc.',
        'bank_number.string' => 'Số tài khoản ngân hàng phải là chuỗi ký tự.',
        'bank_number.max' => 'Số tài khoản ngân hàng không được vượt quá 20 ký tự.',

        'bank_type.required' => 'Loại ngân hàng là bắt buộc.',
        'bank_type.string' => 'Loại ngân hàng phải là chuỗi ký tự.',
        'bank_type.max' => 'Loại ngân hàng không được vượt quá 50 ký tự.',
    ];
}
}
