@extends('mainadmin')

@section('titulo', "Produto #{$p->id}")

@section('conteudo')

<h1>Editar Produto #{{ $p->id }}</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $mensagem)
        ⚠️ {{ $mensagem }} <br>
    @endforeach
</div>
@endif

<form method="POST"
      action="{{ route('prod.salvar', ['id' => $p->id]) }}"
      enctype="multipart/form-data">

    @csrf

    <div class="form-floating mb-3">
        <input
            type="text"
            class="form-control"
            id="nome"
            name="nome"
            placeholder="Nome"
            value="{{ $p->nome }}"
        >
        <label for="nome">Nome do Produto</label>
    </div>

    <div class="form-floating mb-3">
        <textarea
            class="form-control"
            id="descricao"
            name="descricao"
            placeholder="Descrição"
            style="height:120px"
        >{{ $p->descricao }}</textarea>

        <label for="descricao">Descrição</label>
    </div>

    <div class="form-floating mb-3">
        <input
            type="number"
            class="form-control"
            id="quantidade_estoque"
            name="quantidade_estoque"
            placeholder="Estoque"
            value="{{ $p->quantidade_estoque }}"
        >
        <label for="estoque">Estoque</label>
    </div>

    <div class="form-floating mb-3">
        <input
            type="number"
            class="form-control"
            id="valor"
            name="valor"
            step="0.01"
            placeholder="Valor"
            value="{{ $p->valor }}"
        >
        <label for="valor">Valor</label>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Categoria
        </label>

        <select
            name="categoria_id"
            class="form-select"
        >

            @foreach($categorias as $c)

                <option
                    value="{{ $c->id }}"
                    {{ $c->id == $p->categoria_id ? 'selected' : '' }}
                >
                    {{ $c->nome }}
                </option>

            @endforeach

        </select>
    </div>

    @if($p->url)

    <div class="mb-3">

        <label class="form-label">
            Imagem Atual
        </label>

        <br>

        <img
            src="{{ asset($p->url) }}"
            width="120"
            class="img-thumbnail"
        >

    </div>

    @endif

    <div class="mb-3">

        <label class="form-label">
            Nova Imagem
        </label>

        <input
            type="file"
            name="imagem"
            class="form-control"
        >

    </div>

    <button
        type="submit"
        class="btn btn-success"
    >
        Salvar Alterações
    </button>

    <a
        href="{{ route('prod.listar') }}"
        class="btn btn-secondary"
    >
        Cancelar
    </a>

</form>

@endsection