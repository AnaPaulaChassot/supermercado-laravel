@extends('mainadmin')

@section('titulo', 'Nova Cidade')

@section('conteudo')

<h1>Nova Cidade</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $mensagem)
        ⚠️ {{ $mensagem }} <br>
    @endforeach
</div>
@endif

<form method="POST" action="{{ route('cidade.salvar') }}">
    @csrf

    <div class="form-floating mb-3">

        <input
            type="text"
            class="form-control"
            id="nome"
            name="nome"
            placeholder="Nome da Cidade"
            value="{{ old('nome') }}"
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
            value="{{ old('estado') }}"
        >

        <label for="estado">
            Estado
        </label>

    </div>

    <button
        type="submit"
        class="btn btn-success"
    >
        Salvar
    </button>

    <a
        href="{{ route('cidade.listar') }}"
        class="btn btn-secondary"
    >
        Cancelar
    </a>

</form>

@endsection