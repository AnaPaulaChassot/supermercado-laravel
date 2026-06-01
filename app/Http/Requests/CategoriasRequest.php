<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' =>
                'required|min:3|max:255',

            'categoria_pai' =>
                'nullable|exists:categorias,id'
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' =>
                'O nome da categoria é obrigatório.',

            'nome.min' =>
                'A categoria deve ter no mínimo 3 caracteres.',

            'categoria_pai.exists' =>
                'Categoria pai inválida.'
        ];
    }
}