<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Cliente - CaçadorDeOfertas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f8ff;
        }

        .topo {
            background: linear-gradient(90deg, #0d6efd, #0a58ca);
            color: white;
            padding: 20px;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1);
        }
    </style>
</head>

<body>

    <div class="topo">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="logo">
                🛒 CaçadorDeOfertas
            </div>

            <a href="/login" class="btn btn-light">
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
                        <form method="POST" action="{{ route('cliente.salvar') }}">
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
                                        class="form-control"
                                        value="{{ old('senha', $cliente->senha ?? '') }}">
                                </div>


                            </div>

                            

                            <button type="submit" class="btn btn-primary">
                                Salvar Cliente
                            </button>

                            <a href="/login" class="btn btn-secondary">
                                Voltar
                            </a>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>