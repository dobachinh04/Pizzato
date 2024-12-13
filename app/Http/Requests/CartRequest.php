<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'product_size' => 'nullable|string',
            'pizza_edge' => 'nullable|string',
            'pizza_base' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Vui lòng chọn sản phẩm.',
            'product_id.exists' => 'Sản phẩm không hợp lệ.',
            'qty.required' => 'Vui lòng nhập số lượng.',
            'qty.integer' => 'Số lượng phải là số nguyên.',
            'qty.min' => 'Số lượng tối thiểu là 1.',
        ];
    }
}
