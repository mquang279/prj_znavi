<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.productId' => 'required|string',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.unitPrice' => 'required|numeric|min:0',
        ];
    }
}
