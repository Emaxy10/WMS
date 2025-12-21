<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            "name" => "required|string",
            "description" => "nullable|string",
            "category" => "required|string",
            "reorder_level" => "required|integer|min:0",
            "safety_stock" => "required|integer|min:0",
            "unit" => "required|string",
        ];
    }
}
