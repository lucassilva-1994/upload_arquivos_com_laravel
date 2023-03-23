<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array{
        return [
            'name' => 'required| max:100 | min:3',
            'email' => 'required | max:100 | unique:users|email:rfc,dns',
            'cpassword' => 'required | min:8 | max:30',
            'ccpassword' => 'required| same:cpassword'
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'O nome deve ter no mínimo :min caracteres.',
            'name.max' => 'O nome deve ter no máximo :max caracteres.',
            'email.required'=> 'O e-mail é obrigatório.',
            'email.max' => 'O e-mail não pode ter :max caracteres.',
            'email.unique' => 'Esse e-mail já está cadastrado.',
            'email.email' => 'Informe um e-mail válido.',
            'cpassword.min' => 'A senha deve ter no :min caracteres.',
            'cpassword.max' => 'A senha deve ter no :max caracteres.',
            'cpassword.required' => 'A senha é obrigatória.',
            'ccpassword.required' => 'A confirmação de senha é obrigatória.',
            'ccpassword.same' => 'As senhas não conferem.',
        ];
    }
}
