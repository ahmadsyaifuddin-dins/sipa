<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$userId,
            'role' => 'required|in:admin,kasir,pemilik',
        ];

        // Jika sedang CREATE (tambah user baru), password wajib
        if (! $userId) {
            $rules['password'] = 'required|string|min:8';
        } else {
            // Jika sedang EDIT, password opsional
            $rules['password'] = 'nullable|string|min:8';
        }

        return $rules;
    }
}
