<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGRNRequest extends FormRequest
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
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'quantity_received' => 'required|integer|min:1',
            'quantity_rejected' => 'nullable|integer|min:0',
            'received_date' => 'required|date',
            'received_by' => 'required|exists:users,id',
            'remarks' => 'nullable|string',
        ];
    }
}
