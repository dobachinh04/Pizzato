<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
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
    public function rules()
    {
        return [
            'qty' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'qty.required' => 'Vui lòng nhập số lượng.',
            'qty.integer' => 'Số lượng phải là số nguyên.',
            'qty.min' => 'Số lượng tối thiểu là 1.',
        ];
    }
}
