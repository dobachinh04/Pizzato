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
            // 'expire_date' => 'required|date|after:today',
            'expire_date' => 'required|date|after_or_equal:today', // Ngày không được trước hôm nay
            'expire_time' => [
                'required',
                'date_format:H:i', // Định dạng HH:mm
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
            // 'discount' => 'required|numeric|min:0',
            'discount' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    // Nếu loại giảm giá là phần trăm thì không được vượt quá 100
                    if (request()->discount_type === 'percent' && $value > 100) {
                        $fail('Giảm giá theo phần trăm không được vượt quá 100%.');
                    }
                }
            ],
            // 'max_discount_amount' => 'nullable|numeric|min:0',
            'max_discount_amount' => [
                'required_if:discount_type,percent',
                'nullable',
                'numeric',
                'min:0',
            ],
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

            // 'expire_date.required' => 'Vui lòng nhập ngày hết hạn.',
            // 'expire_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            // 'expire_date.after' => 'Ngày hết hạn phải sau ngày hiện tại.',

            'max_discount_amount.numeric' => 'Số tiền giảm tối đa phải là một số.',
            'max_discount_amount.min' => 'Số tiền giảm tối đa không được nhỏ hơn :min.',
            // 'max_discount_amount.required' => 'Vui lòng nhập số tiền tối đa được giảm',
            'max_discount_amount.required_if' => 'Số tiền giảm tối đa là bắt buộc.',

            'expire_date.required' => 'Vui lòng nhập ngày hết hạn.',
            'expire_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            'expire_date.after_or_equal' => 'Giờ không được trước hôm nay.',
            'expire_time.required' => 'Vui lòng nhập giờ hết hạn.',
            'expire_time.date_format' => 'Giờ hết hạn phải có định dạng HH:mm.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.boolean' => 'Trạng thái phải là "Kích hoạt" hoặc "Không kích hoạt".',
        ];
    }
}
