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
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required|exists:clients,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'quantity_ordered' => 'required|integer|min:1',
            'status' => 'required|in:PENDING,RECEIVED,CANCELLED',
            'order_date' => 'required|date',
            'expected_delivery_date' => 'required|date|after_or_equal:order_date',
           'unit_of_measure' => 'required|string|max:10',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg,txt|max:2048',
            // 'quantity_received' => 'required|integer|min:0',
            
        ];
    }
}
