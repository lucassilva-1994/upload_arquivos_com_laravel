<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'nullable|min:3|max:30',
            "files" => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.min' => 'O titulo deve ter no mínimo :min caracteres.',
            'title.max' => 'O titulo não pode ter mais de :max caracteres.',
            'files.required' => 'Selecione o arquivo.'
        ];
    }
}
