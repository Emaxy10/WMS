<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            //
            "code" => "required|string|unique:clients,code",
            "name" => "required|string",
            "business_reg_number" => "required|string|unique:clients,business_reg_number",
            "business_type" => "required|string",
            "billing_address" => "required|string",
        ];
    }
}
