<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:categories',
            // 'status' => 'required',
            // 'show_at_home' => 'required',
        ];
    }
    public function error(): array
    {
        return [
            'name.required' => "tên không được để trống",
            'name.min' => "tên phải ít nhất 3 ký tự ",
            'name.max' => "tên phải nhiều nhất 255 ký tự ",
            'slug.required' => "slug không được để trống",
            'slug.min' => "slug phải ít nhất 3 ký tự ",
            'slug.max' => "slug phải nhiều nhất 255 ký tự ",
            'slug.unique' => 'Slug đã tồn tại',
        ];
    }
    public function run()
    {
        $this->validate($this->rules(), $this->error());
    }
}
