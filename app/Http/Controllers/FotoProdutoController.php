<?php

namespace App\Http\Controllers;

use App\Models\FotoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Requests\FotoProdutosRequest;
use Illuminate\Support\Str;

class FotoProdutoController extends Controller
{
    function listar(Request $req)
    {
        $fotos = FotoProduto::with('produto');

        $pesquisa = "";

        if ($req->filled('pesquisa')) {

            $pesquisa = $req->pesquisa;

            $fotos = $fotos->whereHas('produto', function ($query) use ($pesquisa) {
                $query->where(
                    'nome',
                    'LIKE',
                    "%{$pesquisa}%"
                );
            });
        }

        $fotos = $fotos->paginate(5);

        return view(
            'foto_produtos_listar',
            [
                'fotos' => $fotos,
                'pesquisa' => $pesquisa
            ]
        );
    }

    function novo()
    {
        $produtos = Produto::all();

        return view(
            'foto_produtos_novo',
            [
                'produtos' => $produtos
            ]
        );
    }

    function salvar(FotoProdutosRequest $req, $id = null)
    {
        if ($id) {

            $foto = FotoProduto::findOrFail($id);

            $operacao = "alterada";

        } else {

            $produto = Produto::findOrFail(
                $req->produto_id
            );

            if ($produto->fotos()->count() >= 5) {

                return back()
                    ->withErrors([
                        'foto' =>
                        'Este produto já possui 5 fotos.'
                    ])
                    ->withInput();
            }

            $foto = new FotoProduto();

            $operacao = "inserida";
        }

        $arquivo = $req->file('foto');

        $nomeArquivo =
            Str::slug(
                $req->produto_id .
                '-' .
                time()
            );

        $nomeArquivo .= '.'
            . $arquivo->extension();

        $arquivo->storeAs(
            'produtos',
            $nomeArquivo,
            'public'
        );

        $foto->nome_arquivo =
            $nomeArquivo;

        $foto->produto_id =
            $req->produto_id;

        $foto->save();

        session()->flash(
            'mensagem',
            "A foto foi {$operacao} com sucesso."
        );

        return redirect('/foto-produtos');
    }

    function edit($id)
    {
        $foto = FotoProduto::findOrFail($id);

        $produtos = Produto::all();

        return view(
            'foto_produtos_edit',
            [
                'foto' => $foto,
                'produtos' => $produtos
            ]
        );
    }

    function delete($id)
    {
        FotoProduto::findOrFail($id)
            ->delete();

        return redirect('/foto-produtos');
    }

    function show($id)
    {
        $foto = FotoProduto::with('produto')
            ->findOrFail($id);

        return view(
            'foto_produtos_show',
            [
                'foto' => $foto
            ]
        );
    }
}