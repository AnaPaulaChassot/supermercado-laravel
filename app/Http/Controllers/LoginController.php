<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Produto;
use App\Models\Cliente;

class LoginController extends Controller
{
    public function form()
    {
        return view('login');
    }

    public function login(Request $req)
    {
        $usuario = Usuario::where(
            'email',
            $req->email
        )->first();

        if (!$usuario) {

            return back()
                ->with('erro', 'Usuário não encontrado.');
        }

        if (!Hash::check(
            $req->senha,
            $usuario->senha
        )) {

            return back()
                ->with('erro', 'Senha inválida.');
        }

        session([
            'usuario_id' => $usuario->id,
            'usuario_nome' => $usuario->nome,
            'usuario_tipo' => $usuario->tipo
        ]);


        if ($usuario->tipo == 'administrador') {

            return redirect('/administrador');
        }

        return redirect('/mercado');
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect('/login');
    }

    public function cliente()
    {
        $produtos = Produto::all();

        $cliente = Cliente::where(
            'usuario_id',
            session('usuario_id')
        )->first();

        return view('cliente', [
            'produtos' => $produtos,
            'cliente' => $cliente
        ]);
    }
}
