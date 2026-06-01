@extends('mainadmin')

@section('titulo', 'Novo Produto')

@section('conteudo')

<h1>Novo Produto</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $mensagem)
        ⚠️ {{ $mensagem }} <br>
    @endforeach
</div>
@endif

<form method="POST"
      action="{{ route('prod.salvar') }}"
      enctype="multipart/form-data">

    @csrf

    <div class="form-floating mb-3">
        <input
            type="text"
            class="form-control"
            id="nome"
            name="nome"
            placeholder="Nome do Produto"
            value="{{ old('nome') }}"
        >
        <label for="nome">Nome do Produto</label>
    </div>

    <div class="form-floating mb-3">
        <textarea
            class="form-control"
            id="descricao"
            name="descricao"
            placeholder="Descrição"
            style="height: 120px"
        >{{ old('descricao') }}</textarea>

        <label for="descricao">Descrição</label>
    </div>

    <div class="form-floating mb-3">
        <input
            type="number"
            class="form-control"
            id="quantidade_estoque"
            name="quantidade_estoque"
            placeholder="Quantidade em Estoque"
            value="{{ old('quantidade_estoque') }}"
        >
        <label for="quantidade_estoque">
            Quantidade em Estoque
        </label>
    </div>

    <div class="form-floating mb-3">
        <input
            type="number"
            step="0.01"
            class="form-control"
            id="valor"
            name="valor"
            placeholder="Valor"
            value="{{ old('valor') }}"
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

            <option value="">
                Selecione uma categoria
            </option>

            @foreach($categorias as $c)

                <option
                    value="{{ $c->id }}"
                    {{ old('categoria_id') == $c->id ? 'selected' : '' }}
                >
                    {{ $c->nome }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Imagem do Produto
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
        Salvar
    </button>

    <a
        href="{{ route('prod.listar') }}"
        class="btn btn-secondary"
    >
        Cancelar
    </a>

</form>

@endsection