<?php
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
            'ordered_at' => ['required', 'date'],
            'complete' => ['required'],
            'products' => ['required', 'array'],
            'products.*.name' => ['required', 'string'],
            'products.*.quantity' => ['required', 'integer'],
        ];
    }

    // ...

    public function messages()
    {
        return [
            'products.*.name.required' => __('Product :position is required'),
            'products.*.quantity.required' => __('Quantity is required'),
        ];
    }
}
