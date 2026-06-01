<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'nome' => 'required|min:3|max:255',

            'email' => 'required|email',

            'senha' => 'required|min:6',

            'tipo' => 'required'
        ];
    }
}