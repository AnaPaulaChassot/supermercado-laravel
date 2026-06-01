<hr>

                            <h5>Endereço</h5>

                            <div class="row">

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