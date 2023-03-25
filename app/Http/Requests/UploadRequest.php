<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'nullable|min:3|max:100',
            "files" => 'required|mimes:png,jpg,jpeg,pdf|max:300'
        ];
    }

    public function messages(): array
    {
        return [
            'title.min' => 'O titulo deve ter no mínimo :min caracteres.',
            'title.max' => 'O titulo não pode ter mais de :max caracteres.',
            'files.required' => 'Selecione o arquivo.',
            'files.mimes' => 'Tipo de arquivo não suportado.',
            'files.max' => 'Tamanho máximo permitido.'
        ];
    }
}
