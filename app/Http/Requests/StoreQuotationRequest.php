<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuotationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'customer_id' => [
                'required',
                'exists:customers,id'
            ],

            'items' => [
                'required',
                'array',
                'min:1'
            ],

            'project_name' => [
                'nullable',
                'string',
                'max:191'
            ],

            'items.*.item_name' => [
                'required',
                'string'
            ],

            'items.*.product_id' => [
                'nullable',
                'exists:products,id'
            ],

            'items.*.quantity' => [
                'required',
                'numeric',
                'min:1'
            ],

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0'
            ],

            'items.*.discount' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'items.*.tax_percentage' => [
                'nullable',
                'numeric',
                'min:0'
            ]

        ];
    }
}