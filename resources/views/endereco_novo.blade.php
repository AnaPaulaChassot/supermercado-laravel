<hr>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Endereço - CaçadorDeOfertas</title>

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

            <a href="/carrinho" class="btn btn-light">
                ← Voltar
            </a>

        </div>
    </div>

    <div class="container">

        <div class="row">
            <h3 class="mb-4">Cadastro de Endereço</h3>

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
            <form method="POST" action="{{ route('enderecos.salvar') }}">
                @csrf

                <div class="col-md-6 mb-3">
                    <label class="form-label">Descrição (Casa/Trabalho)</label>
                    <input type="text"
                        name="descricao"
                        class="form-control"
                        value="{{ old('descricao', $endereco->descricao ?? '') }}"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Logradouro</label>
                    <input type="text"
                        name="logradouro"
                        class="form-control"
                        value="{{ old('logradouro', $endereco->logradouro ?? '') }}"
                        required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Número</label>
                    <input type="text"
                        name="numero"
                        class="form-control"
                        value="{{ old('numero', $endereco->numero ?? '') }}"
                        required>
                </div>

                <div class="col-md-8 mb-3">
                    <label class="form-label">Bairro</label>
                    <input type="text"
                        name="bairro"
                        class="form-control"
                        value="{{ old('bairro', $endereco->bairro ?? '') }}"
                        required>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Cidade</label>

                    <select name="cidade_id" class="form-select" required>
                        <option value="">Selecione uma cidade</option>

                        @foreach($cidades as $cidade)
                        <option value="{{ $cidade->id }}"
                            {{ (old('cidade_id', $endereco->cidade_id ?? '') == $cidade->id) ? 'selected' : '' }}>
                            {{ $cidade->nome }}
                        </option>
                        @endforeach
                    </select>
                </div>

        </div>
        <button type="submit" class="btn btn-primary">
            Salvar Endereço
        </button>

        <a href="/carrinho" class="btn btn-secondary">
            Voltar
        </a>

        </form>

    </div>

</body>

</html>