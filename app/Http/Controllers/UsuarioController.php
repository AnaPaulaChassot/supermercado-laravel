<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function listar(Request $req)
    {
        $usuarios = Usuario::query();

        $pesquisa = "";
        $ordem = "";

        if ($req->filled('pesquisa')) {

            $pesquisa = $req->pesquisa;

            $usuarios->where(
                'nome',
                'LIKE',
                "%$pesquisa%"
            );
        }

        if ($req->filled('ordem')) {

            $ordem = $req->ordem;

            if ($ordem == 'crescente') {

                $usuarios->orderBy(
                    'nome',
                    'ASC'
                );

            } else {

                $usuarios->orderBy(
                    'nome',
                    'DESC'
                );
            }
        }

        $usuarios = $usuarios->paginate(5);

        return view(
            'usuarios_listar',
            [
                'usuarios' => $usuarios,
                'pesquisa' => $pesquisa,
                'ordem' => $ordem
            ]
        );
    }

    public function novo()
    {
        return view('usuarios_novo');
    }

    public function salvar(
        UsuarioRequest $req,
        $id = null
    )
    {
        if ($id) {

            $usuario =
                Usuario::findOrFail($id);

            $operacao = "alterado";

        } else {

            $usuario =
                new Usuario();

            $operacao = "inserido";
        }

        $usuario->nome =
            $req->nome;

        $usuario->email =
            $req->email;

        if ($req->filled('senha')) {

            $usuario->senha =
                Hash::make($req->senha);
        }

        $usuario->tipo =
            $req->tipo;

        $usuario->save();

        session()->flash(
            'mensagem',
            "Usuário {$operacao} com sucesso."
        );

        return redirect('/usuarios');
    }

    public function edit($id)
    {
        $usuario =
            Usuario::findOrFail($id);

        return view(
            'usuarios_edit',
            [
                'usuario' => $usuario
            ]
        );
    }

    public function delete($id)
    {
        Usuario::findOrFail($id)
            ->delete();

        return redirect('/usuarios');
    }

    public function show($id)
    {
        $usuario =
            Usuario::findOrFail($id);

        return view(
            'usuarios_show',
            [
                'usuario' => $usuario
            ]
        );
    }
}