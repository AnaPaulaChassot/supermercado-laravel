<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
use App\Models\Cidade;
use App\Models\Cliente;
use App\Http\Requests\EnderecosRequest;

class EnderecoController extends Controller
{
    function listar(Request $req)
    {
        $enderecos = Endereco::with([
            'cidade',
            'cliente'
        ]);

        $pesquisa = "";

        if ($req->filled('pesquisa')) {

            $pesquisa = $req->pesquisa;

            $enderecos = $enderecos->where(
                'logradouro',
                'LIKE',
                "%{$pesquisa}%"
            );
        }

        $enderecos = $enderecos->paginate(5);

        $enderecos->appends([
            'pesquisa' => $pesquisa
        ]);

        return view(
            'enderecos_listar',
            [
                'enderecos' => $enderecos,
                'pesquisa' => $pesquisa
            ]
        );
    }

    function novo()
    {

        $cidades = Cidade::all();
        $clientes = Cliente::all();

        return view(
            'endereco_novo',
            [
                'cidades' => $cidades,
                'clientes' => $clientes
            ]
        );
    }

    function salvar(EnderecosRequest $req, $id = null)
    {
        $cliente = Cliente::where(
            'usuario_id',
            session('usuario_id')
        )->first();

        if ($id) {

            $e = Endereco::findOrFail($id);

            $operacao = "alterado";
        } else {

            $e = new Endereco();

            $operacao = "inserido";
        }

        $e->descricao = $req->descricao;
        $e->logradouro = $req->logradouro;
        $e->numero = $req->numero;
        $e->bairro = $req->bairro;
        $e->cidade_id = $req->cidade_id;
        $e->cliente_id = $cliente->id;

        $e->save();

        session()->flash(
            "mensagem",
            "O endereço foi {$operacao} com sucesso."
        );

        return redirect('/carrinho');
    }

    function edit($id)
    {
        $e = Endereco::findOrFail($id);

        $cidades = Cidade::all();
        $clientes = Cliente::all();

        return view(
            'enderecos_edit',
            [
                'e' => $e,
                'cidades' => $cidades,
                'clientes' => $clientes
            ]
        );
    }

    function delete($id)
    {
        Endereco::findOrFail($id)
            ->delete();

        return redirect('/enderecos');
    }

    function show($id)
    {
        $e = Endereco::with([
            'cidade',
            'cliente'
        ])->findOrFail($id);

        return view(
            'enderecos_show',
            [
                'e' => $e
            ]
        );
    }
}
