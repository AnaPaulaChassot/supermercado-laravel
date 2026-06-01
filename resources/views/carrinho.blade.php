<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Meu carrinho - CaçadorDeOfertas</title>

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
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1);
        }
    </style>
</head>

<body>

    <!-- TOPO -->
    <div class="topo">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="logo">
                🛒 CaçadorDeOfertas
            </div>

            <a href="/mercado" class="btn btn-light">
                ← Continuar comprando
            </a>

        </div>
    </div>

    @php
    $total = 0;
    @endphp

    <div class="container">

        <div class="card">

            <div class="card-body">

                <h3 class="mb-4">
                    Meu carrinho de compras
                </h3>

                <table class="table table-striped table-hover">

                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço un</th>
                            <th>Subtotal</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($itens as $item)

                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->produto->nome ?? '-' }}</td>
                            <td>{{ $item->quantidade }}</td>
                            <td>{{ $item->produto->valor ?? '-' }}</td>
                            <td>
                                R$ {{ number_format($item->produto->valor * $item->quantidade, 2, ',', '.') }}
                            </td>

                            <td>
                                <a href="{{ route('carrinho.delete', $item->id) }}" class="btn btn-danger btn-sm">
                                    Excluir
                                </a>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                Carrinho vazio.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @foreach($itens as $item)
        @php
        $total += $item->produto->valor * $item->quantidade;
        @endphp
        @endforeach

        <div class="text-end">
            <h4>
                Total: R$ {{ number_format($total, 2, ',', '.') }}
            </h4>
        </div>


        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $mensagem)
            ⚠️ {{ $mensagem }} <br>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('vendas.salvar') }}">
            @csrf

            <div class="form-floating mb-3">


                <div class="mb-3">

                    <label class="form-label">
                        Selecione um endereço para entrega:
                    </label>

                    <select name="enderecos_id" class="form-select" required>
                        <option value="">Selecione um endereço</option>

                        @foreach($enderecos as $e)

                        <option
                            value="{{ $e->id }}"
                            {{ old('enderecos_id') == $e->id ? 'selected' : '' }}>
                            {{ $e->descricao }}
                        </option>

                        @endforeach

                    </select>
                    <div class="mt-2">
                        <a href="/enderecos/novo"
                            class="btn btn-warning">
                            Cadastrar novo endereço
                        </a>
                    </div>
                </div>

                <input
                    type="submit"
                    value="Finalizar compra"
                    class="btn btn-success">

        </form>
    </div>

</body>

</html>