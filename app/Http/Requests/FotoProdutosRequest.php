<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FotoProdutosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'produto_id' => 'required|exists:produtos,id',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'produto_id.required' => 'Selecione um produto.',
            'produto_id.exists' => 'Produto inválido.',

            'foto.required' => 'Selecione uma imagem.',
            'foto.image' => 'O arquivo deve ser uma imagem.',
            'foto.max' => 'A imagem deve ter no máximo 2MB.'
        ];
    }
}