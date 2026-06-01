<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CidadesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|min:2|max:255',
            'estado' => 'required|size:2'
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da cidade é obrigatório.',
            'nome.min' => 'O nome da cidade deve possuir no mínimo 2 caracteres.',

            'estado.required' => 'O estado é obrigatório.',
            'estado.size' => 'Informe a UF com 2 caracteres (SC, PR, RS...).'
        ];
    }
}