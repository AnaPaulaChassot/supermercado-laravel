@extends('mainadmin')

@section('titulo', 'Novo Usuário')

@section('conteudo')

<h1>Novo Usuário</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $mensagem)
        ⚠️ {{ $mensagem }} <br>
    @endforeach
</div>
@endif

<form method="POST" action="{{ route('usu.salvar') }}">

    @csrf

    <div class="form-floating mb-3">

        <input
            type="text"
            class="form-control"
            id="nome"
            name="nome"
            placeholder="Nome"
            value="{{ old('nome') }}"
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
            value="{{ old('email') }}"
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
            placeholder="Senha"
        >

        <label for="senha">
            Senha
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
                {{ old('tipo') == 'administrador' ? 'selected' : '' }}
            >
                Administrador
            </option>

            

        </select>

    </div>

    <button
        type="submit"
        class="btn btn-success"
    >
        Salvar
    </button>

    <a
        href="{{ route('usu.listar') }}"
        class="btn btn-secondary"
    >
        Cancelar
    </a>

</form>

@endsection