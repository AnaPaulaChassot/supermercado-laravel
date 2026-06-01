@extends('mainadmin')

@section('titulo', 'Nova Categoria')

@section('conteudo')

<h1>Nova Categoria</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $mensagem)
        ⚠️ {{ $mensagem }} <br>
    @endforeach
</div>
@endif

<form method="POST" action="{{ route('cat.salvar') }}">
    @csrf

    <div class="form-floating mb-3">
        <input
            type="text"
            class="form-control"
            id="nome"
            name="nome"
            placeholder="Nome da Categoria"
            value="{{ old('nome') }}"
        >

        <label for="nome">
            Nome da Categoria
        </label>
    </div>

    <div class="mb-3">

        <label class="form-label">
            Categoria Pai (opcional)
        </label>

        <select
            name="categoria_pai"
            class="form-select"
        >

            <option value="">
                Categoria Principal
            </option>

            @foreach($categorias as $c)

                <option
                    value="{{ $c->id }}"
                    {{ old('categoria_pai') == $c->id ? 'selected' : '' }}
                >
                    {{ $c->nome }}
                </option>

            @endforeach

        </select>

    </div>

    <input
        type="submit"
        value="Salvar"
        class="btn btn-success"
    >

    <a
        href="{{ route('cat.listar') }}"
        class="btn btn-secondary"
    >
        Cancelar
    </a>

</form>

@endsection