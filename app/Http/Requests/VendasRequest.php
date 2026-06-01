<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id' =>
                'required|exists:clientes,id',

            'endereco_id' =>
                'required|exists:enderecos,id',

            'produtos' =>
                'required|array|min:1',

            'produtos.*' =>
                'exists:produtos,id',

            'quantidades' =>
                'required|array',

            'quantidades.*' =>
                'integer|min:1'
        ];
    }
}