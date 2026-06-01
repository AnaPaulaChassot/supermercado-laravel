@extends('mainadmin')

@section('titulo', 'Lista de Usuários')

@section('conteudo')

<h1>Usuários</h1>

@if(session()->has('mensagem'))
<div class="alert alert-info">
    {{ session('mensagem') }}
</div>
@endif

<div>
    <form method="GET" action="#" class="d-flex">

        <input
            type="text"
            name="pesquisa"
            class="form-control"
            placeholder="Pesquisar usuário"
            style="width: 300px;"
            value="{{ $pesquisa }}"
        >

        <input
            type="radio"
            class="btn-check"
            name="ordem"
            id="asc"
            autocomplete="off"
            value="crescente"
            {{ ($ordem == 'crescente' ? 'checked' : '') }}
        >

        <label class="btn btn-secondary" for="asc">
            <i class="bi bi-sort-alpha-down"></i>
        </label>

        <input
            type="radio"
            class="btn-check"
            name="ordem"
            id="desc"
            autocomplete="off"
            value="decrescente"
            {{ ($ordem == 'decrescente' ? 'checked' : '') }}
        >

        <label class="btn btn-secondary" for="desc">
            <i class="bi bi-sort-alpha-down-alt"></i>
        </label>

        <input
            type="submit"
            class="btn btn-primary"
            value="Pesquisar"
        >

    </form>
</div>

<table class="table table-striped mt-3">

    <thead class="bg-primary text-white">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Data Criação</th>
            <th>Operações</th>
        </tr>
    </thead>

    <tbody>

    @foreach($usuarios as $usuario)

        <tr>

            <td>{{ $usuario->id }}</td>

            <td>{{ $usuario->nome }}</td>

            <td>{{ $usuario->email }}</td>

            <td>{{ ucfirst($usuario->tipo) }}</td>

            <td>{{ $usuario->created_at }}</td>

            <td>

                <a
                    href="{{ route('usu.edit', ['id' => $usuario->id]) }}"
                    class="btn btn-warning"
                >
                    Alterar
                </a>

                <button
                    type="button"
                    class="btn btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDelete{{ $usuario->id }}"
                >
                    Excluir
                </button>

            </td>

        </tr>

        <div
            class="modal fade"
            id="modalDelete{{ $usuario->id }}"
            tabindex="-1"
        >

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Confirmar exclusão
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        Deseja realmente excluir o usuário

                        <strong>
                            {{ $usuario->nome }}
                        </strong>?

                    </div>

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Fechar
                        </button>

                        <a
                            href="{{ route('usu.delete', ['id' => $usuario->id]) }}"
                            class="btn btn-outline-danger"
                        >
                            Confirmar exclusão
                        </a>

                    </div>

                </div>

            </div>

        </div>

    @endforeach

    </tbody>

</table>

{{ $usuarios->links('pagination::bootstrap-5') }}

<div>

    <a
        class="btn btn-success"
        href="{{ route('usu.novo') }}"
    >
        Novo Usuário
    </a>

</div>

@endsection