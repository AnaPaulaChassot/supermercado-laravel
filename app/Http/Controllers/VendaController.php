<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Produto;
use App\Models\VendaProduto;
use Illuminate\Http\Request;
use App\Http\Requests\VendasRequest;

class VendaController extends Controller
{
    function listar(Request $req)
    {
        $vendas = Venda::with([
            'cliente',
            'endereco'
        ]);

        $vendas = $vendas
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view(
            'vendas_listar',
            [
                'vendas' => $vendas
            ]
        );
    }

    function novo($id)
        {
    $produto = Produto::findOrFail($id);

    $clientes = Cliente::all();
    $enderecos = Endereco::all();

    return view('vendas_novo', compact(
        'produto',
        'clientes',
        'enderecos'
    ));
    }
    

   function salvar(Request $req)
{
    $req->validate([
        'produto_id' => 'required|exists:produtos,id',
        'quantidade' => 'required|integer|min:1'
    ]);

    $produto = Produto::findOrFail($req->produto_id);

    if ($req->quantidade > $produto->quantidade_estoque) {
        return back()->with('erro', 'Estoque insuficiente.');
    }

    // 👇 pega cliente correto
    $cliente = Cliente::where('usuario_id', session('usuario_id'))->first();

    if (!$cliente) {
        return back()->with('erro', 'Cliente não encontrado.');
    }

    // cria venda
    $venda = new Venda();
    $venda->cliente_id = $cliente->id;
    $endereco = Endereco::where('cliente_id', $cliente->id)->first();

    if (!$endereco) {
        return back()->with('erro', 'Cliente não possui endereço cadastrado.');
    }

    $venda->endereco_id = $endereco->id;
    $venda->valor_total = $produto->valor * $req->quantidade;
    $venda->save();

    // pivot venda-produto
    VendaProduto::create([
        'venda_id' => $venda->id,
        'produto_id' => $produto->id,
        'quantidade' => $req->quantidade,
        'subtotal' => $produto->valor * $req->quantidade
    ]);

    // baixa estoque
    $produto->quantidade_estoque -= $req->quantidade;
    $produto->save();

    return redirect('/vendas')
        ->with('mensagem', 'Venda realizada com sucesso!');
}

    function edit($id)
    {
        $venda =
            Venda::findOrFail($id);

        $clientes =
            Cliente::all();

        $enderecos =
            Endereco::all();

        $produtos =
            Produto::all();

        return view(
            'vendas_edit',
            compact(
                'venda',
                'clientes',
                'enderecos',
                'produtos'
            )
        );
    }

    function delete($id)
    {
        Venda::findOrFail($id)
            ->delete();

        return redirect(
            '/vendas'
        );
    }

    function show($id)
    {
        $venda = Venda::with([
            'cliente',
            'endereco',
            'produtos'
        ])->findOrFail($id);

        return view(
            'vendas_show',
            [
                'venda' => $venda
            ]
        );
    }
}