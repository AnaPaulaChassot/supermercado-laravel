<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Configuracao;
use App\Models\Venda;
use App\Models\Carrinho;
use App\Models\Cliente;

class CompraController extends Controller
{
    public function finalizar($id)
    {
        $venda = Venda::with([
            'cliente',
            'produtos',
            'endereco'
        ])->findOrFail($id);

        /*$cliente = Cliente::with([
            'cliente',
            'produtos',
            'endereco'
        ])->findOrFail($id);*/

        $config = Configuracao::first();

        if (!$config) {
            return view('finalizar', [
                'sucesso' => false,
                'mensagem' => 'Configuração da integração não encontrada.'
            ]);
        }

        // CaçaPay

        

        $pagamento = Http::post(
            $config->url_cacapay . '/api/compras',
            [
                'cpf'   => $venda->cliente->cpf,
                'token' => $config->token_cacapay,
                'valor' => $venda->valor_total,
                'nome'  => $venda->cliente->nome,
                'email' => $venda->cliente->email,
            ]
        );



        if (!$pagamento->successful()) {

            $venda->status_pagamento = 'Negado';
            $venda->save();

            return view('finalizar', [
                'sucesso' => false,
                'mensagem' => $pagamento->json('message')
                    ?? 'Pagamento recusado.'
            ]);
        }



        DB::transaction(function () use ($venda) {

            $venda->status_pagamento = 'Aprovado';
            $venda->save();

            foreach ($venda->produtos as $produto) {

                $produto->quantidade_estoque -=
                    $produto->pivot->quantidade;

                $produto->save();
            }

            Carrinho::where(
                'cliente_id',
                $venda->cliente_id
            )->delete();
        });

        // CaçaLog

        $conteudo = [];

        foreach ($venda->produtos as $produto) {

            $conteudo[] = [
                'nome' => $produto->nome,
                'quantidade' => $produto->pivot->quantidade
            ];
        }


        $entrega = Http::post(
            $config->url_cacalog . '/api/entregas',
            [

                'token' => $config->token_cacalog,

                'codigo_pedido' => 'PED-' . $venda->id,

                'cep' => $venda->endereco->cep,

                'logradouro' => $venda->endereco->logradouro,

                'numero' => $venda->endereco->numero,

                'complemento' => null,

                'bairro' => $venda->endereco->bairro,

                'nome_destinatario' =>
                $venda->cliente->nome,


                'conteudo' =>
                $venda->produtos->map(function ($produto) {

                    return [
                        'nome' => $produto->nome,

                        'quantidade' =>
                        $produto->pivot->quantidade
                    ];
                })->values()->toArray()

            ]
        );

        /*dd(
            $entrega->status(),
            $entrega->json(),
            $entrega->body()
        ); //descobrir status entrega */

        if ($entrega->successful()) {

            $venda->status_entrega = 'Pendente';
        } else {

            $venda->status_entrega = 'Erro ao solicitar entrega';
        }

        $venda->save();

        return view('finalizar', [

            'sucesso' => true,

            'mensagem' => 'Pagamento aprovado com sucesso!',

            'entrega' => $entrega->json()

        ]);
    }
}
