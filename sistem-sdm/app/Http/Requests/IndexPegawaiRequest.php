<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexPegawaiRequest
 * 
 * Menangani validasi input user (query parameters) untuk endpoint Index Pegawai.
 */
class IndexPegawaiRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Dapatkan aturan validasi untuk request ini.
     * 
     * MENGAPA: Validasi yang ketat mencegah input berbahaya (SQL Injection via orderBy) 
     * dan memastikan array sort yang dikirim memiliki struktur yang konsisten.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:100'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1'],
            'sort' => ['nullable', 'array'],
            'sort.*.field' => ['required_with:sort', 'string', 'in:nama,nip,golongan,status_kepegawaian'],
            'sort.*.dir' => ['required_with:sort', 'string', 'in:asc,desc'],
        ];
    }
}
