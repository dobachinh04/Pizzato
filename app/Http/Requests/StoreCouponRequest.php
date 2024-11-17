<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép tất cả người dùng sử dụng request này, điều chỉnh theo nhu cầu
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:coupons,code',
            'qty' => 'required|integer|min:0',
            'min_purchase_amount' => 'required|numeric|min:0',
            'expire_date' => 'required|date|after:today',
            'discount_type' => 'required|in:percent,amount',
            'discount' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên mã giảm giá.',
            'name.string' => 'Tên mã giảm giá phải là một chuỗi ký tự.',
            'name.max' => 'Tên mã giảm giá không được vượt quá :max ký tự.',

            'code.required' => 'Vui lòng nhập mã giảm giá.',
            'code.string' => 'Mã giảm giá phải là một chuỗi ký tự.',
            'code.unique' => 'Mã giảm giá đã tồn tại, vui lòng chọn mã khác.',
            'code.max' => 'Mã giảm giá không được vượt quá :max ký tự.',

            'qty.required' => 'Vui lòng nhập số lượng mã giảm giá.',
            'qty.integer' => 'Số lượng phải là một số nguyên.',
            'qty.min' => 'Số lượng phải ít nhất là :min.',

            'min_purchase_amount.integer' => 'Số tiền tối thiểu phải là một số nguyên.',
            'min_purchase_amount.min' => 'Số tiền tối thiểu không được nhỏ hơn :min.',

            'discount_type.required' => 'Vui lòng chọn loại giảm giá.',
            'discount_type.in' => 'Loại giảm giá không hợp lệ, chỉ được chọn "percent" hoặc "amount".',

            'discount.required' => 'Vui lòng nhập giá trị giảm.',
            'discount.numeric' => 'Giá trị giảm phải là một số.',
            'discount.min' => 'Giá trị giảm không được nhỏ hơn :min.',

            'expire_date.required' => 'Vui lòng nhập ngày hết hạn.',
            'expire_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            'expire_date.after' => 'Ngày hết hạn phải sau ngày hiện tại.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.boolean' => 'Trạng thái phải là "Kích hoạt" hoặc "Không kích hoạt".',
        ];
    }
}
