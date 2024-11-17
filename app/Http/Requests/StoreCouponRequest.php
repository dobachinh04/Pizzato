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
            'name.required' => 'Tên mã giảm giá không được để trống.',
            'name.string' => 'Tên mã giảm giá phải là chuỗi ký tự.',
            'name.max' => 'Tên mã giảm giá không được vượt quá 255 ký tự.',
            'code.required' => 'Mã giảm giá không được để trống.',
            'code.string' => 'Mã giảm giá phải là chuỗi ký tự.',
            'code.max' => 'Mã giảm giá không được vượt quá 20 ký tự.',
            'code.unique' => 'Mã giảm giá đã tồn tại.',
            'qty.required' => 'Số lượng không được để trống.',
            'qty.integer' => 'Số lượng phải là số nguyên.',
            'qty.min' => 'Số lượng không được nhỏ hơn 0.',
            'min_purchase_amount.required' => 'Số tiền mua tối thiểu không được để trống.',
            'min_purchase_amount.numeric' => 'Số tiền mua tối thiểu phải là số.',
            'min_purchase_amount.min' => 'Số tiền mua tối thiểu không được nhỏ hơn 0.',
            'expire_date.required' => 'Ngày hết hạn không được để trống.',
            'expire_date.date' => 'Ngày hết hạn phải là ngày hợp lệ.',
            'expire_date.after' => 'Ngày hết hạn phải sau ngày hôm nay.',
            'discount_type.required' => 'Loại giảm giá không được để trống.',
            'discount_type.in' => 'Loại giảm giá phải là "percent" hoặc "amount".',
            'discount.required' => 'Giá trị giảm giá không được để trống.',
            'discount.numeric' => 'Giá trị giảm giá phải là số.',
            'discount.min' => 'Giá trị giảm giá không được nhỏ hơn 0.',
        ];
    }
}
