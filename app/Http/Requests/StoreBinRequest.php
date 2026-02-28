<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBinRequest extends FormRequest
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

            'code' => 'required|string|max:255|unique:bins,code',
            'description' => 'nullable|string|max:255',
            'rack_id' => 'required|integer|exists:racks,id',
            'capacity' => 'required|integer|min:0',
            'level' => 'required|integer|min:1',
        ];
    }
}
