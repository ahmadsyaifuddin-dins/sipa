<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JasaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Mengambil ID item jika sedang proses edit
        $itemId = $this->route('jasa') ? $this->route('jasa')->id : null;

        return [
            'kode' => 'required|string|max:50|unique:items,kode,'.$itemId,
            'nama' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'kode.unique' => 'Kode jasa sudah digunakan, silakan masukkan kode lain.',
            'category_id.exists' => 'Kategori tidak valid.',
        ];
    }
}
