<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda - SuperCaçador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f8ff;
        }

        .topo {
            background: linear-gradient(90deg, #0d6efd, #0a58ca);
            color: white;
            padding: 20px;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 30px;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,.1);
        }

        .produto-img {
            max-height: 300px;
            object-fit: cover;
        }
    </style>
</head>

<body>

<!-- TOPO -->
<div class="topo">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">🛒 SuperCaçador</div>

        <a href="/cliente" class="btn btn-light">
            Voltar
        </a>
    </div>
</div>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-body">

                    <h3 class="mb-4">Finalizar Venda</h3>

                    {{-- MENSAGEM DE SUCESSO --}}
                    @if(session('mensagem'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('mensagem') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- MENSAGEM DE ERRO --}}
                    @if(session('erro'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('erro') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- PRODUTO --}}
                    @if(!isset($produto))
                        <div class="alert alert-warning">
                            Produto não encontrado.
                        </div>
                    @else

                        <div class="text-center mb-4">

                            @if($produto->url)
                                <img src="{{ asset($produto->url) }}"
                                     class="img-fluid produto-img mb-3">
                            @endif

                            <h4>{{ $produto->nome }}</h4>

                            <p>{{ $produto->descricao }}</p>

                            <h5 class="text-primary">
                                R$ {{ number_format($produto->valor,2,',','.') }}
                            </h5>

                            <p>
                                Estoque disponível:
                                <strong>{{ $produto->quantidade_estoque }}</strong>
                            </p>

                        </div>

                        {{-- FORMULÁRIO DE VENDA --}}
                        <form method="POST" action="{{ route('vendas.salvar') }}">
                            @csrf

                            <input type="hidden" name="produto_id" value="{{ $produto->id }}">

                            <div class="mb-3">
                                <label class="form-label">Quantidade</label>

                                <input type="number"
                                       name="quantidade"
                                       class="form-control"
                                       min="1"
                                       max="{{ $produto->quantidade_estoque }}"
                                       required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                Confirmar Venda
                            </button>
                        </form>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>