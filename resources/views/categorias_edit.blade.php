@extends('mainadmin')

@section('titulo', "Categoria #{$c->id}")

@section('conteudo')

<h1>Editar Categoria #{{ $c->id }}</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $mensagem)
        ⚠️ {{ $mensagem }} <br>
    @endforeach
</div>
@endif

<form method="POST"
      action="{{ route('cat.salvar', ['id' => $c->id]) }}">

    @csrf

    <div class="form-floating mb-3">

        <input
            type="text"
            class="form-control"
            id="nome"
            name="nome"
            placeholder="Nome da Categoria"
            value="{{ $c->nome }}"
        >

        <label for="nome">
            Nome da Categoria
        </label>

    </div>

    <div class="mb-3">

        <label class="form-label">
            Categoria Pai
        </label>

        <select
            name="categoria_pai"
            class="form-select"
        >

            <option value="">
                Categoria Principal
            </option>

            @foreach($categorias as $categoria)

                @if($categoria->id != $c->id)

                <option
                    value="{{ $categoria->id }}"
                    {{ $categoria->id == $c->categoria_pai ? 'selected' : '' }}
                >
                    {{ $categoria->nome }}
                </option>

                @endif

            @endforeach

        </select>

    </div>

    <button
        type="submit"
        class="btn btn-success"
    >
        Salvar Alterações
    </button>

    <a
        href="{{ route('cat.listar') }}"
        class="btn btn-secondary"
    >
        Cancelar
    </a>

</form>

@endsection