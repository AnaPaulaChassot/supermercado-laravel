<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação.
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|max:255',
            'cpf' => 'required|max:14',

            'rg' => 'nullable|max:20',
            'data_nascimento' => 'nullable|date',
            'telefone' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
        ];
    }

    /**
     * Mensagens personalizadas.
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome deve possuir no máximo 255 caracteres.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.max' => 'O CPF deve possuir no máximo 14 caracteres.',

            'data_nascimento.date' => 'Informe uma data válida.',

            'email.email' => 'Informe um e-mail válido.',
            'email.max' => 'O e-mail deve possuir no máximo 255 caracteres.',
        ];
    }
}