<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Produto;
use App\Models\VendaProduto;
use Illuminate\Http\Request;
use App\Http\Requests\VendasRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Carrinho;

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
        DB::beginTransaction();

        try {

            $cliente = Cliente::where(
                'usuario_id',
                session('usuario_id')
            )->firstOrFail();

            $itens = Carrinho::with('produto')
                ->where('cliente_id', $cliente->id)
                ->get();

            if ($itens->isEmpty()) {

                return back()->withErrors([
                    'O carrinho está vazio.'
                ]);
            }

            $valorTotal = 0;

            foreach ($itens as $item) {

                $valorTotal +=
                    $item->produto->valor *
                    $item->quantidade;
            }

            // cria a venda
            $venda = Venda::create([
                'cliente_id'  => $cliente->id,
                'endereco_id' => $req->enderecos_id,
                'valor_total' => $valorTotal
            ]);

            // salva os produtos da venda
            foreach ($itens as $item) {

                $subtotal =
                    $item->produto->valor *
                    $item->quantidade;

                VendaProduto::create([
                    'venda_id'   => $venda->id,
                    'produto_id' => $item->produto_id,
                    'quantidade' => $item->quantidade,
                    'subtotal'   => $subtotal
                ]);

                // baixa estoque
                $produto = Produto::findOrFail(
                    $item->produto_id
                );

                $produto->quantidade_estoque -=
                    $item->quantidade;

                $produto->save();
            }

            // limpa carrinho
            Carrinho::where(
                'cliente_id',
                $cliente->id
            )->delete();

            DB::commit();

            return redirect('/mercado')
                ->with(
                    'mensagem',
                    'Compra realizada com sucesso!'
                );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withErrors([
                $e->getMessage()
            ]);
        }
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
