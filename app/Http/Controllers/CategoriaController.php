<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Http\Requests\CategoriasRequest;

class CategoriaController extends Controller
{
    function listar(Request $req)
    {
        $categorias = Categoria::with('pai');

        $pesquisa = "";
        $ordem = "";

        if ($req->filled('pesquisa')) {

            $pesquisa = $req->input('pesquisa');

            $categorias = $categorias->where(
                'nome',
                'LIKE',
                "%$pesquisa%"
            );
        }

        if ($req->filled('ordem')) {

            $ordem = $req->input('ordem');

            if ($ordem == 'crescente') {

                $categorias = $categorias
                    ->orderBy('nome', 'ASC');

            } else {

                $categorias = $categorias
                    ->orderBy('nome', 'DESC');
            }
        }

        $categorias = $categorias->paginate(5);

        $categorias->appends([
            'pesquisa' => $pesquisa,
            'ordem' => $ordem
        ]);

        return view(
            'categorias_listar',
            [
                'categorias' => $categorias,
                'pesquisa' => $pesquisa,
                'ordem' => $ordem
            ]
        );
    }

    function novo()
    {
        $categorias = Categoria::all();

        return view(
            'categorias_novo',
            [
                'categorias' => $categorias
            ]
        );
    }

    function salvar(CategoriasRequest $req, $id = null)
    {
        if ($id) {

            $c = Categoria::findOrFail($id);

            $operacao = "alterada";

        } else {

            $c = new Categoria();

            $operacao = "inserida";
        }

        $c->nome = $req->nome;
        $c->categoria_pai = $req->categoria_pai;

        $c->save();

        session()->flash(
            "mensagem",
            "A categoria {$c->nome} foi {$operacao} com sucesso."
        );

        return redirect('/categorias');
    }

    function edit($id)
    {
        $c = Categoria::findOrFail($id);

        $categorias = Categoria::where(
            'id',
            '!=',
            $id
        )->get();

        return view(
            'categorias_edit',
            [
                'c' => $c,
                'categorias' => $categorias
            ]
        );
    }

    function delete($id)
    {
        Categoria::findOrFail($id)
            ->delete();

        return redirect('/categorias');
    }

    function show($id)
    {
        $c = Categoria::with('pai')
            ->findOrFail($id);

        return view(
            'categorias_show',
            [
                'c' => $c
            ]
        );
    }
}