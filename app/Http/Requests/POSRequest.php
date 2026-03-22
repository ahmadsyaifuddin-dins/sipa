<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class POSRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'total_harga' => 'required|numeric|min:0',
            'bayar' => 'required|numeric|gte:total_harga', // Uang bayar harus >= total harga
            'kembali' => 'required|numeric|min:0',

            // Validasi Array Item di Keranjang
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:items,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.harga' => 'required|integer|min:0',
            'items.*.subtotal' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Keranjang belanja masih kosong!',
            'bayar.gte' => 'Uang pembayaran tidak mencukupi.',
        ];
    }
}
