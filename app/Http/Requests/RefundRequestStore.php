<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefundRequestStore extends FormRequest
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
            'email' => 'required|email|max:255',
            'invoice_id' => 'required|exists:orders,invoice_id',
            'refund_amount' => 'required|numeric|min:0',
            'refund_reason' => 'required|string',
            'bank_number' => 'required|string|max:20',
            'bank_type' => 'required|string|max:50',
        ];
    }
}
