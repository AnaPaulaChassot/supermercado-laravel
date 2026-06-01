<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|min:3|max:255',
            'descricao' => 'nullable|max:1000',
            'quantidade_estoque' =>
                'required|integer|min:0',
            'valor' =>
                'required|numeric|min:0',
            'categoria_id' =>
                'required|exists:categorias,id',
            'imagem' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' =>
                'O nome do produto é obrigatório.',

            'nome.min' =>
                'O nome deve ter no mínimo 3 caracteres.',

            'valor.required' =>
                'O valor é obrigatório.',

            'valor.numeric' =>
                'O valor deve ser numérico.',

            'quantidade_estoque.required' =>
                'O estoque é obrigatório.',

            'categoria_id.required' =>
                'Selecione uma categoria.',

            'categoria_id.exists' =>
                'Categoria inválida.',

            'imagem.image' =>
                'O arquivo deve ser uma imagem.'
        ];
    }
}