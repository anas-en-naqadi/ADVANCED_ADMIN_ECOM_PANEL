<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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

            'status' => 'required|string',
            'due_date' => 'required|date',
            'products.*' => 'required',
            'user_id' => 'required'
        ];
    }
    public function messages()
{
    return [
        'user_id.required' => 'The customer field is required.',
    ];
}
}