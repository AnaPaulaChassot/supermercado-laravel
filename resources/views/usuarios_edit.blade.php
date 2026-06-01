@extends('mainadmin')

@section('titulo', 'Editar Usuário')

@section('conteudo')

<h1>Editar Usuário #{{ $usuario->id }}</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $mensagem)
        ⚠️ {{ $mensagem }} <br>
    @endforeach
</div>
@endif

<form method="POST"
      action="{{ route('usu.salvar', ['id' => $usuario->id]) }}">

    @csrf

    <div class="form-floating mb-3">

        <input
            type="text"
            class="form-control"
            id="nome"
            name="nome"
            placeholder="Nome"
            value="{{ $usuario->nome }}"
        >

        <label for="nome">
            Nome
        </label>

    </div>

    <div class="form-floating mb-3">

        <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="Email"
            value="{{ $usuario->email }}"
        >

        <label for="email">
            Email
        </label>

    </div>

    <div class="form-floating mb-3">

        <input
            type="password"
            class="form-control"
            id="senha"
            name="senha"
            placeholder="Nova Senha"
        >

        <label for="senha">
            Nova Senha
        </label>

    </div>

    <div class="mb-3">

        <label class="form-label">
            Tipo de Usuário
        </label>

        <select
            name="tipo"
            class="form-select"
        >

            <option
                value="administrador"
                {{ $usuario->tipo == 'administrador' ? 'selected' : '' }}
            >
                Administrador
            </option>

            <option
                value="cliente"
                {{ $usuario->tipo == 'cliente' ? 'selected' : '' }}
            >
                Cliente
            </option>

        </select>

    </div>

    <button
        type="submit"
        class="btn btn-success"
    >
        Salvar Alterações
    </button>

    <a
        href="{{ route('usu.listar') }}"
        class="btn btn-secondary"
    >
        Cancelar
    </a>

</form>

@endsection