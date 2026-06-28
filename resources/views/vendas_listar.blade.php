@extends('mainadmin')

@section('titulo', 'Lista de Vendas')

@section('conteudo')

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
                        <th>Status Pagamento</th>
                        <th>Status Entrega</th>
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
                                {{ $venda->status_pagamento ?? 'Pendente' }}
                            </td>

                            <td>
                                {{ $venda->status_entrega ?? 'Aguardando' }}
                            </td>
                            <td>
                                {{ $venda->created_at }}
                            </td>

                            <td>
                                <!-- <a href="{{ route('vendas.show', $venda->id) }}" class="btn btn-info btn-sm">
                                    Ver
                                </a> -->

                                <a href="{{ route('vendas.delete', $venda->id) }}" class="btn btn-danger btn-sm">
                                    Excluir
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">
                                Nenhuma venda encontrada.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection