
    @extends('maincliente')

    @section('titulo', 'Administrador')

    @section('conteudo')

    <div class="topo">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="logo">
                🛒 CaçadorDeOfertas
            </div>

            <a href="/mercado" class="btn btn-light">
                ← Voltar
            </a>

        </div>
    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-9">

                <div class="card">

                    <div class="card-body p-4">

                        <h3 class="mb-4">Dados do Cliente</h3>

                        {{-- MENSAGENS --}}
                        @if(session('mensagem'))
                        <div class="alert alert-success">
                            {{ session('mensagem') }}
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $erro)
                            {{ $erro }} <br>
                            @endforeach
                        </div>
                        @endif

                        {{-- FORM --}}
                        <form method="POST" action="{{ route('cliente.salvar', $cliente->id) }}">
                            @csrf

                            {{-- CLIENTE --}}
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Nome Completo</label>
                                    <input type="text"
                                        name="nome"
                                        class="form-control"
                                        value="{{ old('nome', $cliente->nome ?? '') }}"
                                        required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">CPF</label>
                                    <input type="text"
                                        name="cpf"
                                        class="form-control"
                                        value="{{ old('cpf', $cliente->cpf ?? '') }}"
                                        required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">RG</label>
                                    <input type="text"
                                        name="rg"
                                        class="form-control"
                                        value="{{ old('rg', $cliente->rg ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Data de Nascimento</label>
                                    <input type="date"
                                        name="data_nascimento"
                                        class="form-control"
                                        value="{{ old('data_nascimento', $cliente->data_nascimento ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Telefone</label>
                                    <input type="text"
                                        name="telefone"
                                        class="form-control"
                                        value="{{ old('telefone', $cliente->telefone ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">E-mail</label>
                                    <input type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email', $cliente->email ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Senha</label>
                                    <input type="password"
                                        name="senha"
                                        class="form-control">
                                </div>


                            </div>

                            

                            <button type="submit" class="btn btn-primary">
                                Salvar Cliente
                            </button>

                            <a href="/mercado" class="btn btn-secondary">
                                Voltar
                            </a>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    
@endsection