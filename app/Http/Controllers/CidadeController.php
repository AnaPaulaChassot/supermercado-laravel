<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Http\Requests\CidadesRequest;

class CidadeController extends Controller
{
    function listar(Request $req)
    {
        $cidades = Cidade::query();

        $pesquisa = "";
        $ordem = "";

        if ($req->filled('pesquisa')) {

            $pesquisa = $req->pesquisa;

            $cidades = $cidades->where(
                'nome',
                'LIKE',
                "%{$pesquisa}%"
            );
        }

        if ($req->filled('ordem')) {

            $ordem = $req->ordem;

            if ($ordem == 'crescente') {

                $cidades = $cidades
                    ->orderBy('nome', 'ASC');

            } else {

                $cidades = $cidades
                    ->orderBy('nome', 'DESC');
            }
        }

        $cidades = $cidades->paginate(5);

        $cidades->appends([
            'pesquisa' => $pesquisa,
            'ordem' => $ordem
        ]);

        return view(
            'cidades_listar',
            [
                'cidades' => $cidades,
                'pesquisa' => $pesquisa,
                'ordem' => $ordem
            ]
        );
    }

    function novo()
    {
        return view('cidades_novo');
    }

    function salvar(CidadesRequest $req, $id = null)
    {
        if ($id) {

            $cidade = Cidade::findOrFail($id);

            $operacao = "alterada";

        } else {

            $cidade = new Cidade();

            $operacao = "inserida";
        }

        $cidade->nome = $req->nome;
        $cidade->estado = strtoupper($req->estado);

        $cidade->save();

        session()->flash(
            'mensagem',
            "A cidade {$cidade->nome} foi {$operacao} com sucesso."
        );

        return redirect('/cidades');
    }

    function edit($id)
    {
        $cidade = Cidade::findOrFail($id);

        return view(
            'cidades_edit',
            [
                'cidade' => $cidade
            ]
        );
    }

    function delete($id)
    {
        Cidade::findOrFail($id)
            ->delete();

        return redirect('/cidades');
    }

    function show($id)
    {
        $cidade = Cidade::findOrFail($id);

        return view(
            'cidades_show',
            [
                'cidade' => $cidade
            ]
        );
    }
}