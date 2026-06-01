@extends('mainadmin')

@section('titulo', 'Produtos')

@section('conteudo')

<h1>Produtos</h1>

@if(session()->has('mensagem'))

<div class="alert alert-info">
    {{ session('mensagem') }}
</div>
@endif

<div class="mb-3">
    <form method="GET" action="#" class="d-flex gap-2">


    <input
        type="text"
        name="pesquisa"
        class="form-control"
        placeholder="Pesquisar produto"
        style="width:300px"
        value="{{ $pesquisa }}"
    >

    <input
        type="radio"
        class="btn-check"
        name="ordem"
        id="asc"
        autocomplete="off"
        value="crescente"
        {{ $ordem == 'crescente' ? 'checked' : '' }}
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
        {{ $ordem == 'decrescente' ? 'checked' : '' }}
    >

    <label class="btn btn-secondary" for="desc">
        <i class="bi bi-sort-alpha-down-alt"></i>
    </label>

    <button type="submit" class="btn btn-primary">
        Pesquisar
    </button>

</form>


</div>

<table class="table table-striped table-hover">


<thead class="table-primary">
    <tr>
        <th>ID</th>
        <th>Imagem</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Estoque</th>
        <th>Valor</th>
        <th>Slug</th>
        <th>Data Criação</th>
        <th>Operações</th>
    </tr>
</thead>

<tbody>

@foreach($produtos as $p)

    <tr>

        <td>{{ $p->id }}</td>

        <td>
            @if($p->url)
                <img
                    src="{{ $p->url }}"
                    width="70"
                    class="img-thumbnail"
                >
            @endif
        </td>

        <td>{{ $p->nome }}</td>

        <td>
            {{ $p->categoria->nome ?? '' }}
        </td>

        <td>{{ $p->quantidade_estoque }}</td>

        <td>
            R$ {{ number_format($p->valor, 2, ',', '.') }}
        </td>

        <td>{{ $p->slug }}</td>

        <td>{{ $p->created_at }}</td>

        <td>

            <a
                href="/produtos/show/{{ $p->id }}"
                class="btn btn-info btn-sm"
            >
                Ver
            </a>

            <a
                href="/produtos/edit/{{ $p->id }}"
                class="btn btn-warning btn-sm"
            >
                Alterar
            </a>

            <button
                type="button"
                class="btn btn-danger btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalDelete{{ $p->id }}"
            >
                Excluir
            </button>

        </td>

    </tr>

    <div class="modal fade"
         id="modalDelete{{ $p->id }}"
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
                    Deseja realmente excluir o produto
                    <strong>{{ $p->nome }}</strong>?
                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <a
                        href="/produtos/delete/{{ $p->id }}"
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

{{ $produtos->links('pagination::bootstrap-5') }}

<div class="mt-3">


<a
    href="/produtos/novo"
    class="btn btn-success"
>
    Novo Produto
</a>


</div>

@endsection
