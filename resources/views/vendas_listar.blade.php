<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Vendas - SuperCaçador</title>

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
            font-size: 30px;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,.1);
        }
    </style>
</head>

<body>

<!-- TOPO -->
<div class="topo">
    <div class="container d-flex justify-content-between align-items-center">

        <div class="logo">
            🛒 SuperCaçador
        </div>

        <a href="/cliente" class="btn btn-light">
            ← Voltar
        </a>

    </div>
</div>

<div class="container">

    <div class="card">

        <div class="card-body">

            <h3 class="mb-4">
                Lista de Vendas
            </h3>

            @if(session('mensagem'))
                <div class="alert alert-success">
                    {{ session('mensagem') }}
                </div>
            @endif

            <table class="table table-striped table-hover">

                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Endereço</th>
                        <th>Total</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($vendas as $venda)

                        <tr>
                            <td>{{ $venda->id }}</td>
                            <td>{{ $venda->cliente->nome ?? '-' }}</td>
                            <td>{{ $venda->endereco->descricao ?? '-' }}</td>
                            <td>
                                R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                            </td>
                            <td>
                                {{ $venda->created_at }}
                            </td>

                            <td>
                                <a href="{{ route('vendas.show', $venda->id) }}" class="btn btn-info btn-sm">
                                    Ver
                                </a>

                                <a href="{{ route('vendas.delete', $venda->id) }}" class="btn btn-danger btn-sm">
                                    Excluir
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                Nenhuma venda encontrada.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>