<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAduanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    return [
        'nama_pelapor' => ['required', 'string', 'max:255'],
        'wa' => ['nullable', 'string', 'max:30'],

        'darurat' => ['required', 'boolean'],

        'isi_aduan' => ['required', 'string'],
        'kategori' => [
    'required',
    'in:fasilitas,tenaga kerja,kelengkapan obat,pelayanan kesehatan,emergency,non emergency'
],
        'lokasi' => ['required', 'string', 'max:255'],

        // foto/pdf max 5MB
        'lampiran' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
    ];
}
}