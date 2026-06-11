<?php

namespace App\Http\Requests;

use App\Models\Pasien;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class PasienRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $pasien = $this->route('pasien');
        $pasienId = $pasien instanceof Pasien ? $pasien->id_pasien : $pasien;

        return [
            'nama' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('pasien', 'email')->ignore($pasienId, 'id_pasien'),
            ],
            'password' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
            'no_hp' => ['required', 'string', 'max:15'],
            'tgl_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'alamat' => ['required', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'no_hp.required' => 'No. HP wajib diisi.',
            'no_hp.max' => 'No. HP maksimal 15 karakter.',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tgl_lahir.date' => 'Tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
        ];
    }
}
