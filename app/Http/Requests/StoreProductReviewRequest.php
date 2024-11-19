<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductReviewRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [
    //         'product_id' => 'required|exists:products,id',
    //         'rating' => 'required|numeric|min:0|max:5',
    //         'review' => 'required|string',
    //     ];
    // }
    // public function messages(): array
    // {
    //     return [
    //         'product_id.required' => "Sản phẩm không được để trống.",
    //         'product_id.exists' => "Sản phẩm không tồn tại.",
    //         'rating.required' => "Đánh giá không được để trống.",
    //         'rating.numeric' => "Đánh giá phải là một số.",
    //         'rating.min' => "Đánh giá không được nhỏ hơn 0.",
    //         'rating.max' => "Đánh giá không được lớn hơn 5.",
    //         'review.required' => "Nội dung đánh giá không được để trống.",
    //         'review.string' => "Nội dung đánh giá phải là một chuỗi.",
    //     ];
    // }
}
