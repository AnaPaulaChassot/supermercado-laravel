<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descricao' => 'required|min:3|max:255',
            'logradouro' => 'required|max:255',
            'numero' => 'required|max:10',
            'bairro' => 'required|max:255',

            'cidade_id' =>
                'required|exists:cidades,id',

            //'cliente_id' =>
              //  'required|exists:clientes,id'
        ];
    }

    public function messages(): array
    {
        return [
            'descricao.required' =>
                'A descrição é obrigatória.',

            'logradouro.required' =>
                'O logradouro é obrigatório.',

            'numero.required' =>
                'O número é obrigatório.',

            'bairro.required' =>
                'O bairro é obrigatório.',

            'cidade_id.required' =>
                'Selecione uma cidade.',

            'cliente_id.required' =>
                'Selecione um cliente.'
        ];
    }
}