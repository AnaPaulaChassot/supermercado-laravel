<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrinho;
use App\Models\Cliente;
use App\Models\Endereco;


class CarrinhoController extends Controller
{
    public function adicionar(Request $req)
    {
        $cliente = Cliente::where(
            'usuario_id',
            session('usuario_id')
        )->first();

        $item = Carrinho::where(
            'cliente_id',
            $cliente->id
        )->where(
            'produto_id',
            $req->produto_id
        )->first();

        if ($item) {

            $item->quantidade += $req->quantidade;
            $item->save();
        } else {

            Carrinho::create([
                'cliente_id' => $cliente->id,
                'produto_id' => $req->produto_id,
                'quantidade' => $req->quantidade
            ]);
        }

        return back()->with(
            'mensagem',
            'Produto adicionado ao carrinho!'
        );
    }

    public function listar()
    {
        $cliente = Cliente::where(
            'usuario_id',
            session('usuario_id')
        )->first();

        $itens = Carrinho::with('produto')
            ->where('cliente_id', $cliente->id)
            ->get();

        $enderecos = Endereco::where(
            'cliente_id',
            $cliente->id
        )->get();

        return view('carrinho', [
            'itens' => $itens,
            'enderecos' => $enderecos,
            'cliente' => $cliente
        ]);
    }

    function delete($id)
    {
        Carrinho::findOrFail($id)
            ->delete();

        return redirect(
            '/carrinho'
        );
    }
}
