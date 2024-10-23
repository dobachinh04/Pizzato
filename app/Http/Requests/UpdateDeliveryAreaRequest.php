<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryAreaRequest extends FormRequest
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
            'area_name' => 'required|string|max:255', // Tên khu vực là bắt buộc, kiểu chuỗi, tối đa 255 ký tự
            'min_delivery_time' => 'required|string|max:50', // Thời gian giao hàng tối thiểu là bắt buộc, kiểu chuỗi, tối đa 50 ký tự
            'max_delivery_time' => 'required|string|max:50', // Thời gian giao hàng tối đa là bắt buộc, kiểu chuỗi, tối đa 50 ký tự
            'delivery_fee' => 'required|numeric', // Phí giao hàng là bắt buộc, kiểu số
            'status' => 'required|boolean', // Trạng thái là bắt buộc, kiểu boolean
        ];
    }

    /**
     * Các thông điệp lỗi tùy chỉnh cho xác thực.
     *
     * @return array
     */
    public function messages()
    {
        return [
           'area_name.required' => 'Tên khu vực là bắt buộc.',
            'area_name.requirred' => 'Tên khu vực là bắt buộc.',
            'area_name.max' => 'Tên khu vực có độ dài tối đa là 255 ký tự',
            'min_delivery_time.required' => 'Thời gian giao hàng tối thiểu là bắt buộc.',
            'min_delivery_time.max' => 'Thời gian giao hàng tối thiểu không được quá 50 ký tự.',
            'max_delivery_time.required' => 'Thời gian giao hàng tối đa là bắt buộc.',
            'max_delivery_time.max' => 'Thời gian giao hàng tối thiểu không được quá 50 ký tự.',
            'delivery_fee.required' => 'Phí giao hàng là bắt buộc.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'area_name.string' => 'Tên khu vực phải là một chuỗi.',
            'min_delivery_time.string' => 'Thời gian giao hàng tối thiểu phải là một chuỗi.',
            'max_delivery_time.string' => 'Thời gian giao hàng tối đa phải là một chuỗi.',
            'delivery_fee.numeric' => 'Phí giao hàng phải là một số.',
            'status.boolean' => 'Trạng thái phải là đúng hoặc sai.', // Thông điệp cho trạng thái
        ];
    }
}