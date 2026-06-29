
    @extends('maincliente')

    @section('titulo', 'Perfil')

    @section('conteudo')
    


    <!-- Cabeçalho -->
    <div class="topo">

        <div class="container">

            <div class="d-flex justify-content-between align-items-center">

                <div class="logo">
                    🛒 Caçador<span>DeOfertas</span>
                </div>

                @if(session()->has('usuario_id'))
                <div>

                    <a href="/carrinho"
                        class="btn btn-light">
                        Meu carrinho
                    </a>

                    <a href="/clientes/edit/{{ $cliente->id }}"
                        class="btn btn-light">
                        Perfil
                    </a>

                    <form method="POST" action="/logout" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">
                            Sair
                        </button>
                    </form>

                </div>
                @else
                <div>

                    <a href="/login"
                        class="btn btn-light">
                        Entre
                    </a>

                    <a href="/clientes/novo"
                        class="btn btn-outline-light">
                        Cadastre-se
                    </a>

                </div>
                @endif

            </div>

        </div>

    </div>

    <div class="container mt-4">

        <!-- Pesquisa -->
        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <form method="GET" action="{{ route('mercado') }}">

                    <div class="input-group">

                        <input
                            type="text"
                            class="form-control"
                            name="pesquisa"
                            placeholder="Pesquisar produtos...">

                        <button
                            class="btn btn-primary"
                            type="submit">
                            Pesquisar
                        </button>

                    </div>

                </form>

            </div>

        </div>

        {{-- sucesso --}}
        @if(session('mensagem'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('mensagem') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- erro --}}
        @if(session('erro'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('erro') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- produtos --}}

        <div class="row">
            @foreach($produtos as $produto)

            <div class="col-md-4 mb-4">

                <div class="card card-produto h-100 shadow-sm">

                    @if($produto->url)

                    <img
                        src="{{ asset($produto->url) }}"
                        class="card-img-top produto-img"
                        alt="{{ $produto->nome }}">

                    @else

                    <img
                        src="https://via.placeholder.com/400x250"
                        class="card-img-top produto-img">

                    @endif

                    <div class="card-body">

                        <h5 class="card-title">
                            {{ $produto->nome }}
                        </h5>

                        <p class="card-text">

                            {{ $produto->descricao }}

                        </p>

                        <p>

                            <strong>
                                R$ {{ number_format($produto->valor,2,',','.') }}
                            </strong>

                        </p>

                        <p>

                            Estoque:
                            {{ $produto->quantidade_estoque }}

                        </p>




                        <form method="POST" action="{{ route('carrinho.adicionar') }}">
                            @csrf

                            <input type="hidden" name="produto_id" value="{{ $produto->id }}">

                            <div class="mb-3">
                                <label class="form-label">Quantidade</label>

                                <input type="number"
                                    name="quantidade"
                                    class="form-control"
                                    min="1"
                                    max="{{ $produto->quantidade_estoque }}"
                                    value="1"
                                    required>
                            </div>
                            <div class="card-footer bg-white">
                                @if(session()->has('usuario_id'))


                                <button type="submit" class="btn btn-primary w-100">
                                    Adicionar ao carrinho
                                </button>


                                @else

                                <a
                                    href="/login"
                                    class="btn btn-primary w-100">

                                    Entre para comprar

                                </a>



                                @endif
                            </div>

                        </form>
                    </div>


                </div>

            </div>

            @endforeach
        </div>

    </div>

@endsection
