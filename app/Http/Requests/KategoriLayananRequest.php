<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriLayananRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'id_kategori' => [
                'required',
                'string',
                'kode' => ['required', 'regex:/^[A-Z]+$/'],
                'max:3',
                'unique:kategori_layanan,id_kategori,' .
                    $this->route('kategori_layanan')?->id_kategori .
                    ',id_kategori'
            ],

            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                'unique:kategori_layanan,nama_kategori,' .
                    $this->route('kategori_layanan')?->id_kategori .
                    ',id_kategori'
            ],

            'keterangan' => [
                'nullable',
                'string'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter.',
        ];
    }
}
