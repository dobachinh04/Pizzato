<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductSizeRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên kích thước là bắt buộc.',
            'name.string' => 'Tên kích thước phải là chuỗi ký tự.',
            'name.max' => 'Tên kích thước không được vượt quá 255 ký tự.',

            'price.required' => 'Giá là bắt buộc.',
            'price.numeric' => 'Giá phải là một số.',
            'price.min' => 'Giá không được nhỏ hơn 0.',

            'image.image' => 'Hình ảnh phải là định dạng ảnh.',
            'image.mimes' => 'Hình ảnh chỉ chấp nhận các định dạng jpg, jpeg, png.',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ];
    }
}
