<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusAduanRequest extends FormRequest
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
        'status' => ['required', 'in:baru,diproses,selesai'],
         'feedback_admin' => ['nullable', 'string'],
    ];
}

}
