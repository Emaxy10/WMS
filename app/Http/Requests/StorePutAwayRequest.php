<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePutAwayRequest extends FormRequest
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

                'grn_id' => 'required|exists:grns,id',
                'product_id' => 'required|exists:products,id',
                'warehouse_id' => 'required|exists:warehouses,id',
                'user_id' => 'required|exists:users,id',
                // 'zone_id' => 'required|exists:zones,id',
                // 'rack_id' => 'required|exists:racks,id',
                'quantity' => 'required|integer|min:1',
        ];
    }
}
