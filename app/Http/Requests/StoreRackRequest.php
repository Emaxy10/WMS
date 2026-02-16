<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRackRequest extends FormRequest
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
            //"code" => "required|string",
            "description" => "required|string",
            "zone_id" => "required|integer|exists:zones,id",
            "capacity_weight" => "required|decimal:0,2|min:0",
            "current_load" => "required|integer|min:0",
            "number_of_levels" => "required|integer|min:1",
        ];
    }
}
