<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Http\Requests\ProdutosRequest;
use Illuminate\Support\Str;

class ProdutoController extends Controller
{
    function listar(Request $req)
    {
        $produtos = Produto::with('categoria');

        $pesquisa = "";
        $ordem = "";

        if ($req->filled('pesquisa')) {

            $pesquisa = $req->input('pesquisa');

            $produtos = $produtos->where(
                'nome',
                'LIKE',
                "%$pesquisa%"
            );
        }

        if ($req->filled('ordem')) {

            $ordem = $req->input('ordem');

            if ($ordem == 'crescente') {

                $produtos = $produtos
                    ->orderBy('nome', 'ASC');

            } else {

                $produtos = $produtos
                    ->orderBy('nome', 'DESC');
            }
        }

        $produtos = $produtos->paginate(5);

        $produtos->appends([
            'pesquisa' => $pesquisa,
            'ordem' => $ordem
        ]);

        return view(
            'produtos_listar',
            [
                'produtos' => $produtos,
                'pesquisa' => $pesquisa,
                'ordem' => $ordem
            ]
        );
    }

    function novo()
    {
        $categorias = Categoria::all();

        return view(
            'produtos_novo',
            [
                'categorias' => $categorias
            ]
        );
    }

    function salvar(ProdutosRequest $req, $id = null)
    {
        if ($id) {

            $p = Produto::findOrFail($id);

            $operacao = "alterado";

        } else {

            $p = new Produto();

            $operacao = "inserido";
        }

        $p->nome = $req->nome;
        $p->descricao = $req->descricao;
        $p->quantidade_estoque =
            $req->quantidade_estoque;

        $p->valor = $req->valor;
        $p->categoria_id =
            $req->categoria_id;

        // gerar slug automaticamente
        $p->slug =
            Str::slug($req->nome);

        $p->save();

        // upload imagem
        if ($req->hasFile('imagem')) {

            $imagem =
                $req->file('imagem');

            $nomeArquivo =
                "{$p->nome}-{$p->id}";

            $nomeArquivo =
                Str::of($nomeArquivo)
                    ->slug('-');

            $nomeArquivo =
                $nomeArquivo . '.'
                . $imagem->extension();

            $nomeArquivo =
                $imagem->storeAs(
                    'produtos',
                    $nomeArquivo,
                    'public'
                );

            $p->url =
                "/storage/$nomeArquivo";

            $p->save();
        }

        session()->flash(
            "mensagem",
            "O produto {$p->nome} foi {$operacao} com sucesso."
        );

        return redirect('/produtos');
    }

    function edit($id)
    {
        $p = Produto::findOrFail($id);

        $categorias =
            Categoria::all();

        return view(
            'produtos_edit',
            [
                'p' => $p,
                'categorias' =>
                    $categorias
            ]
        );
    }

    function delete($id)
    {
        Produto::findOrFail($id)
            ->delete();

        return redirect('/produtos');
    }

    function show($id)
    {
        $p = Produto::with('categoria')
            ->findOrFail($id);

        return view(
            'produtos_show',
            [
                'p' => $p
            ]
        );
    }
}