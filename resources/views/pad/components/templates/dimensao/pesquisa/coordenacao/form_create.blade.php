
<div id="pesquisa_coordenacao">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Pesquisa - Coordenação </h3 class="h3">
        </div>
        <form action="{{route('pesquisa_coordenacao_create')}}" method="post" id="pesquisa_coordenacao-form" class="">
            @csrf
        
            <div class="row">
                
                <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{$user_pad_id}}">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror" type="text" name="cod_atividade" id="cod_atividade" value="{{ old('cod_atividade') }}" readonly>
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="titulo_projeto">Título do Projeto</label>
                    <input class="form-control @error('titulo_projeto') is-invalid @enderror" type="text" name="titulo_projeto" id="titulo_projeto" value="{{ old('titulo_projeto') }}">
                    @error('titulo_projeto')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="linha_grupo_pesquisa">Linha & Grupo de Pesquisa</label>
                    <input class="form-control @error('linha_grupo_pesquisa') is-invalid @enderror" type="text" name="linha_grupo_pesquisa" id="linha_grupo_pesquisa" value="{{ old('linha_grupo_pesquisa') }}">
                    @error('linha_grupo_pesquisa')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-sm-4">
                    <label class="form-label" for="funcao">Função</label>
                    <select class="form-select @error('funcao') is-invalid @enderror" name="funcao" id="funcao" value="{{ old('funcao') }}">
                        <option value="0">Selecione uma Função</option>
                        @foreach($funcoesProjeto as $value => $funcao)
                            @if( $value == old('funcao') )
                                <option selected value="{{$value}}">{{$funcao}}</option>
                            @else
                                <option value="{{$value}}">{{$funcao}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('funcao')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-sm-4">
                    <label class="form-label" for="ch_semanal">CH. Semanal</label>
                    <input class="form-control @error('ch_semanal') is-invalid @enderror" type="number" name="ch_semanal" id="ch_semanal" value="{{ old('ch_semanal') }}">
                    @error('ch_semanal')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mt-1 text-end">
                @include('components.buttons.btn-save', [
                    'content' => 'Cadastrar'
                ])
            </div>
            
        </form>
    </div>

    <div class="border rounded px-4 mt-4">

        <table class="table table-hover" id="ensino_aulas-table-">
            <thead>
                <tr>
                    <!-- <th scole="col">#</th> -->
                    <th scope="col"> Cód </th>
                    <th scope="col"> Título do Projeto </th>
                    <th scope="col"> Linha & Grupo de Pesquisa </th>
                    <th scope="col"> Função </th>
                    <th scope="col"> CH Semanal </th>
                    <th scope="col"> Opções </th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($pesquisasCoordenacao as $pesquisaCoordenacao)
                <tr>
                    <td>{{ $pesquisaCoordenacao->cod_atividade }}</td>
                    <td>{{ $pesquisaCoordenacao->titulo_projeto }}</td>
                    <td>{{ $pesquisaCoordenacao->linha_grupo_pesquisa }}</td>
                    <td>{{ $pesquisaCoordenacao->funcaoAsString() }}</td>
                    <td>{{ $pesquisaCoordenacao->ch_semanal }}</td>
                    <td>
                        @include('components.buttons.btn-edit-task', [
                            'btn_class' => 'btn-edit_pesquisa_coordenacao',
                            'btn_id' => $pesquisaCoordenacao->id
                        ])

                        @include('components.buttons.btn-delete', [
                            'id' => $pesquisaCoordenacao->id,
                            'route' => route('pesquisa_coordenacao_delete', ['id' => $pesquisaCoordenacao->id])
                        ])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>