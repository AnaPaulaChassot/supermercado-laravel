
    @extends('maincliente')

    @section('titulo', 'Pagamento')

    @section('conteudo')
    

   <div class="container mt-5">

    @if($sucesso)

        <div class="alert alert-success">
            <h3>Pagamento aprovado!</h3>
            <p>{{ $mensagem }}</p>
        </div>

        <a href="/mercado" class="btn btn-primary">
            Continuar comprando
        </a>

    @else

        <div class="alert alert-danger">
            <h3>Pagamento recusado</h3>
            <p>{{ $mensagem }}</p>
        </div>

        <a href="/carrinho" class="btn btn-warning">
            Voltar ao carrinho
        </a>

    @endif

</div>

@endsection