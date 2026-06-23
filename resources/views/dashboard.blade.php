@extends('mainadmin')

@section('titulo', 'Dashboard')

@section('conteudo')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📊 Dashboard</h3>
    </div>

    <!-- CARDS RESUMO -->
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card content-card p-3">
                <h6>Total de Clientes</h6>
                <h3 class="text-primary">
                    {{ $clientes->count() }}
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card content-card p-3">
                <h6>Total de Vendas</h6>
                <h3 class="text-success">
                    {{ $vendasPorMes->sum('total_vendas') }}
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card content-card p-3">
                <h6>Faturamento Total</h6>
                <h3 class="text-danger">
                    R$ {{ number_format($vendasPorMes->sum('faturamento'), 2, ',', '.') }}
                </h3>
            </div>
        </div>

    </div>

    <!-- GRÁFICOS -->
    <div class="row">

        <div class="col-md-6">
            <div class="card content-card p-3">
                <h5 class="mb-3">📦 Vendas por Mês</h5>
                <canvas id="vendasChart" height="120"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card content-card p-3">
                <h5 class="mb-3">👥 Clientes por Mês</h5>
                <canvas id="clientesChart" height="120"></canvas>
            </div>
        </div>

    </div>

    <!-- TABELA CLIENTES -->
    <div class="card content-card mt-4 p-3">

        <h5 class="mb-3">🧾 Clientes e Vendas</h5>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Cliente</th>
                        <th>Total de Vendas</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td class="fw-semibold">
                                {{ $cliente->nome ?? 'Sem nome' }}
                            </td>

                            <td>
                                <span class="badge bg-primary">
                                    {{ $cliente->vendas_count }}
                                </span>
                            </td>

                            <td>
                                <span class="text-success fw-bold">
                                    R$ {{ number_format($cliente->vendas_sum_valor_total ?? 0, 2, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>



@endsection