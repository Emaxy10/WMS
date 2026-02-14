<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateZoneRequest extends FormRequest
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
            "description" => "required|string",
            "warehouse_id" => "required|integer|exists:warehouses,id",
            "type" => "required|string",
            "temperature_controlled" => "required|boolean",
            "restricted_access" => "required|boolean",
    ];
    }
}
