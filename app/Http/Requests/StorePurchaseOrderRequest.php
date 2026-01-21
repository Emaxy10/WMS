<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseOrderRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:users,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'quantity_ordered' => 'required|integer|min:1',
            'status' => 'required|in:PENDING,RECEIVED,CANCELLED',
            'quantity_received' => 'required|integer|min:0',
            'quantity_ordered' => 'required|integer|min:1',
        ];
    }
}
