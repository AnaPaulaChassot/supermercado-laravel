<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Cidade;
use App\Models\Endereco;
use App\Http\Requests\ClientesRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\Produto;

class ClienteController extends Controller
{

    public function cliente(Request $req)
    {
        $produtos = Produto::query();

        if ($req->filled('pesquisa')) {

            $produtos->where(
                'nome',
                'LIKE',
                '%' . $req->pesquisa . '%'
            );
        }

        $produtos = $produtos->get();

        $cliente = Cliente::where(
            'usuario_id',
            session('usuario_id')
        )->first();

        return view('cliente', [
            'produtos' => $produtos,
            'cliente' => $cliente
        ]);
    }

    function listar(Request $req)
    {
        $clientes = Cliente::query();
        $pesquisa = "";
        $ordem = "";

        if ($req->filled('pesquisa')) {
            $pesquisa = $req->input("pesquisa");
            $clientes = $clientes->where('nome', 'LIKE', "%$pesquisa%");
        }

        if ($req->filled('ordem')) {
            $ordem = $req->input('ordem');
            if ($ordem == 'crescente') {
                $clientes = $clientes->orderBy('nome', 'ASC');
            } else {
                $clientes = $clientes->orderBy('nome', 'DESC');
            }
        }

        $clientes = $clientes->paginate(20);
        $clientes->appends([
            'pesquisa' => $pesquisa,
            'ordem' => $ordem
        ]);

        return view(
            'clientes_listar',
            ['clientes' => $clientes, 'pesquisa' => $pesquisa, 'ordem' => $ordem]
        );
    }

    function novo()
    {

        return view('cliente_novo');
    }

    /*function salvar(ClientesRequest $req, $id=null){
        if ($id) {
            $c = Cliente::findOrFail($id);
            $operacao = "alterado";
        } else {
            $c = new Cliente();
            $operacao = "inserido";
        }
        $c->nome = $req->nome;
        $c->cpf = $req->cpf;
        $c->rg = $req->rg;
        $c->data_nascimento = $req->data_nascimento;
        $c->telefone = $req->telefone;
        $c->email = $req->email;
        $c->senha = $req->senha;
        $c->usuario_id = $req->usuario_id;
        $c->save();       

        session()->flash("mensagem", "O cliente {$c->nome} foi {$operacao} com sucesso.");

        return redirect('/mercado');
    }*/

    /*function novo()
    {
        $cliente = Cliente::where(
            'usuario_id',
            session('usuario_id')
        )->first();

        $cidades = Cidade::all();

        $endereco = $cliente?->enderecos?->first();

        return view('cliente_novo', [
            'cliente' => $cliente,
            'endereco' => $endereco,
            'cidades' => $cidades,
        
        ]);
    }*/


    public function salvar(Request $req, $id = null)
    {
        DB::beginTransaction();

        try {

            if ($id) {

                // EDITAR CLIENTE
                $cliente = Cliente::findOrFail($id);

                $dadosCliente = [
                    'nome' => $req->nome,
                    'cpf' => $req->cpf,
                    'rg' => $req->rg,
                    'data_nascimento' => $req->data_nascimento,
                    'telefone' => $req->telefone,
                    'email' => $req->email,
                ];

                if (!empty($req->senha)) {
                    $dadosCliente['senha'] = Hash::make($req->senha);
                }

                $cliente->update($dadosCliente);

                // ATUALIZA USUÁRIO RELACIONADO
                $usuario = Usuario::findOrFail($cliente->usuario_id);

                $usuario->nome = $req->nome;
                $usuario->email = $req->email;

                // só altera a senha se foi informada
                if (!empty($req->senha)) {
                    $usuario->senha = Hash::make($req->senha);
                }

                $usuario->save();
            } else {

                // CADASTRO NOVO
                $usuario = Usuario::create([
                    'nome' => $req->nome,
                    'email' => $req->email,
                    'senha' => Hash::make($req->senha),
                    'tipo' => 'cliente'
                ]);

                $cliente = Cliente::create([
                    'nome' => $req->nome,
                    'cpf' => $req->cpf,
                    'rg' => $req->rg,
                    'data_nascimento' => $req->data_nascimento,
                    'telefone' => $req->telefone,
                    'email' => $req->email,
                    'senha' => Hash::make($req->senha),
                    'usuario_id' => $usuario->id
                ]);
            }

            DB::commit();

            return redirect()
                ->back()
                ->with('mensagem', 'Cliente salvo com sucesso!');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'erro',
                $e->getMessage()
            );
        }
    }

    function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        //$cidades = Cidade::all();

        return view('cliente_edit', [
            'cliente' => $cliente
        ]);
    }

    function delete($id)
    {
        Cliente::findOrFail($id)->delete();

        return redirect('/clientes');
    }
}
