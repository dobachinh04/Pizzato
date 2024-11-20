<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:coupons,code,' . $this->coupon->id,
            'qty' => 'required|integer|min:0',
            'min_purchase_amount' => 'required|numeric|min:0',
            // 'expire_date' => 'required|date|after:today',
            'expire_date' => 'required|date|after_or_equal:today',
            'expire_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    // Ghép ngày và giờ để kiểm tra
                    $expireDateTime = \Carbon\Carbon::createFromFormat(
                        'Y-m-d H:i',
                        request()->expire_date . ' ' . $value
                    );

                    if ($expireDateTime->isPast()) {
                        $fail('Thời gian hết hạn phải sau thời gian hiện tại.');
                    }
                }
            ],
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

            // 'expire_date.required' => 'Ngày hết hạn không được để trống.',
            // 'expire_date.date' => 'Ngày hết hạn phải là ngày hợp lệ.',
            // 'expire_date.after' => 'Ngày hết hạn phải sau ngày hôm nay.',

            'expire_date.required' => 'Vui lòng nhập ngày hết hạn.',
            'expire_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            'expire_date.after_or_equal' => 'Ngày hết hạn không được trước hôm nay.',
            'expire_time.required' => 'Vui lòng nhập giờ hết hạn.',
            'expire_time.date_format' => 'Giờ hết hạn phải có định dạng HH:mm.',

            'discount_type.required' => 'Loại giảm giá không được để trống.',
            'discount_type.in' => 'Loại giảm giá phải là "percent" hoặc "amount".',
            'discount.required' => 'Giá trị giảm giá không được để trống.',
            'discount.numeric' => 'Giá trị giảm giá phải là số.',
            'discount.min' => 'Giá trị giảm giá không được nhỏ hơn 0.',
        ];
    }
}
