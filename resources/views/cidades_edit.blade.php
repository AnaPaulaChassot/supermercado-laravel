@extends('mainadmin')

@section('titulo', 'Editar Cidade ')

@section('conteudo')

<h1>Editar Cidade #{{ $cidade->id }}</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $mensagem)
        ⚠️ {{ $mensagem }} <br>
    @endforeach
</div>
@endif

<form method="POST"
      action="{{ route('cidade.salvar', ['id' => $cidade->id]) }}">

    @csrf

    <div class="form-floating mb-3">

        <input
            type="text"
            class="form-control"
            id="nome"
            name="nome"
            placeholder="Nome da Cidade"
            value="{{ $cidade->nome }}"
        >

        <label for="nome">
            Nome da Cidade
        </label>

    </div>

    <div class="form-floating mb-3">

        <input
            type="text"
            class="form-control"
            id="estado"
            name="estado"
            placeholder="Estado"
            value="{{ $cidade->estado }}"
        >

        <label for="estado">
            Estado
        </label>

    </div>

    <button
        type="submit"
        class="btn btn-success"
    >
        Salvar Alterações
    </button>

    <a
        href="{{ route('cidade.listar') }}"
        class="btn btn-secondary"
    >
        Cancelar
    </a>

</form>

@endsection