
    @extends('maincliente')

    @section('titulo', 'Endereço')

    @section('conteudo')
    

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

                <div class="col-md-4 mb-3">
                    <label class="form-label">CEP</label>
                    <input type="text"
                        name="cep"
                        class="form-control"
                        value="{{ old('cep', $endereco->cep ?? '') }}"
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

    @endsection
