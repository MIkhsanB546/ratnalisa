<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


class LayananRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {


        return [
            'id_kategori' => ['required', 'string', 'max:3'],
            'nama_layanan' => ['required', 'string', 'max:100'],
            'harga' => ['required', 'numeric', 'min:0', 'regex:/^\\d+(\\.\\d{1,2})?$/'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_layanan.required' => 'Nama layanan wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
