@extends('mainadmin')

@section('titulo', 'Lista de Categorias')

@section('conteudo')

<h1>Categorias</h1>

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
            placeholder="Pesquisar categoria"
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

<table class="table table-striped table-hover mt-3">

    <thead class="bg-primary text-white">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria Pai</th>
            <th>Data Criação</th>
            <th>Operações</th>
        </tr>
    </thead>

    <tbody>

    @foreach($categorias as $c)

        <tr>

            <td>{{ $c->id }}</td>

            <td>{{ $c->nome }}</td>

            <td>
                {{ $c->categoriaPai->nome ?? 'Categoria Principal' }}
            </td>

            <td>{{ $c->created_at }}</td>

            <td>

                <a
                    href="{{ route('cat.edit', ['id' => $c->id]) }}"
                    class="btn btn-warning"
                >
                    Alterar
                </a>

                <button
                    type="button"
                    class="btn btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDelete{{ $c->id }}"
                >
                    Excluir
                </button>

            </td>

        </tr>

        <div class="modal fade"
             id="modalDelete{{ $c->id }}"
             tabindex="-1">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Confirmar Exclusão
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        Deseja realmente excluir a categoria

                        <strong>
                            {{ $c->nome }}
                        </strong>?

                    </div>

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Cancelar
                        </button>

                        <a
                            href="{{ route('cat.delete', ['id' => $c->id]) }}"
                            class="btn btn-danger"
                        >
                            Confirmar
                        </a>

                    </div>

                </div>

            </div>

        </div>

    @endforeach

    </tbody>

</table>

{{ $categorias->links('pagination::bootstrap-5') }}

<div>

    <a
        href="{{ route('cat.novo') }}"
        class="btn btn-success"
    >
        Nova Categoria
    </a>

</div>

@endsection