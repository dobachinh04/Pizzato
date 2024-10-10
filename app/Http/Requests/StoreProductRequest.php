<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'slug' => 'required|string|max:255|unique:products,slug', //unique:products,slug: truong duy nhất trong bảng products, cột slug
            'thumb_image' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',   // giá trị của category_id có tồn tại trong bảng categories ?
            'view' => 'nullable|integer|min:0',
            'short_description' => 'nullable|string|max:500',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric|min:0', // numeric: Trường phải là số (bao gồm cả số nguyên và số thực)
            'offer_price' => 'nullable|numeric|min:0|lt:price', //lt:price:offer_price phải nhỏ hơn price
            'qty' => 'required|integer|min:0',
            'sku' => 'required|string|max:255|unique:products,sku',
            'show_at_home' => 'required|boolean',   // 1 or 0
            'status' => 'required|boolean',
        ];
    }

    public function  messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',

            'slug.required' => 'Slug là bắt buộc.',
            'slug.string' => 'Slug phải là chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại, vui lòng chọn slug khác.',

            // 'thumb_image.required' => 'Ảnh đại diện là bắt buộc.',
            'thumb_image.url' => 'Ảnh đại diện phải là một URL hợp lệ.',

            'category_id.required' => 'Danh mục là bắt buộc.',
            'category_id.exists' => 'Danh mục không tồn tại.',

            'view.integer' => 'Lượt xem phải là một số nguyên.',
            'view.min' => 'Lượt xem phải lớn hơn hoặc bằng 0.',

            'short_description.string' => 'Mô tả ngắn phải là chuỗi ký tự.',
            'short_description.max' => 'Mô tả ngắn không được vượt quá 500 ký tự.',

            'long_description.string' => 'Mô tả dài phải là chuỗi ký tự.',

            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.numeric' => 'Giá phải là một số hợp lệ.',
            'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',

            'offer_price.numeric' => 'Giá giảm phải là một số hợp lệ.',
            'offer_price.min' => 'Giá giảm phải lớn hơn hoặc bằng 0.',
            'offer_price.lt' => 'Giá giảm phải nhỏ hơn giá gốc.',

            'qty.required' => 'Số lượng là bắt buộc.',
            'qty.integer' => 'Số lượng phải là số nguyên.',
            'qty.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',

            'sku.required' => 'Mã SKU là bắt buộc.',
            'sku.string' => 'Mã SKU phải là chuỗi ký tự.',
            'sku.max' => 'Mã SKU không được vượt quá 255 ký tự.',
            'sku.unique' => 'Mã SKU đã tồn tại, vui lòng chọn mã khác.',

            'show_at_home.required' => 'Trường hiển thị trên trang chủ là bắt buộc.',
            'show_at_home.boolean' => 'Giá trị hiển thị trên trang chủ chỉ có thể là Yes hoặc No.',

            'status.required' => 'Trạng thái là bắt buộc.',
            'status.boolean' => 'Trạng thái chỉ có thể là Active hoặc Inactive.',
        ];
    }

    // public function run()
    // {
    //     $this->validate($this->rules(), $this->error());
    // }
}