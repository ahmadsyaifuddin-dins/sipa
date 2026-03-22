<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Mengambil ID item jika sedang proses edit
        $itemId = $this->route('atk') ? $this->route('atk')->id : null;

        return [
            'kode' => 'required|string|max:50|unique:items,kode,'.$itemId,
            'nama' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ];
    }

    public function messages(): array
    {
        return [
            'kode.unique' => 'Kode barang sudah digunakan, silakan masukkan kode lain.',
            'category_id.exists' => 'Kategori tidak valid.',
            'foto.image' => 'File harus berupa gambar (jpeg, png, jpg).',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
