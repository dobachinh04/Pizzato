<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductReviewRequest extends FormRequest
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
    //     public function rules(): array
    //     {
    //         return [
    //             'rating' => 'required|numeric|min:0|max:5',
    //             'review' => 'required|string',
    //         ];
    //     }
    //     public function messages(): array
    // {
    //     return [
    //         'rating.required' => "Đánh giá không được để trống.",
    //         'rating.numeric' => "Đánh giá phải là một số.",
    //         'rating.min' => "Đánh giá phải lớn hơn hoặc bằng 0.",
    //         'rating.max' => "Đánh giá không được vượt quá 5.",
    //         'review.required' => "Nội dung đánh giá không được để trống.",
    //         'review.string' => "Nội dung đánh giá phải là một chuỗi ký tự.",
    //     ];
    // }
}
