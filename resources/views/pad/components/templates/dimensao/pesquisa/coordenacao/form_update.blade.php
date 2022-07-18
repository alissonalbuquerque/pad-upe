
<div id="pesquisa_coordenacao">
    <div>
        <form action="{{route('pesquisa_coordenacao_update', ['id' => $model->id])}}" method="post" id="pesquisa_coordenacao-form" class="">
            @csrf
        
            <div class="row">
                
                <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{$model->user_pad_id}}">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror" type="text" name="cod_atividade" id="cod_atividade" value="{{ $model->cod_atividade }}" readonly>
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="titulo_projeto">Título do Projeto</label>
                    <input class="form-control @error('titulo_projeto') is-invalid @enderror" type="text" name="titulo_projeto" id="titulo_projeto" value="{{ $model->titulo_projeto }}">
                    @error('titulo_projeto')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="linha_grupo_pesquisa">Linha & Grupo de Pesquisa</label>
                    <input class="form-control @error('linha_grupo_pesquisa') is-invalid @enderror" type="text" name="linha_grupo_pesquisa" id="linha_grupo_pesquisa" value="{{ $model->linha_grupo_pesquisa }}">
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
                            @if( $value == $model->funcao )
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
                    <input class="form-control @error('ch_semanal') is-invalid @enderror" type="number" name="ch_semanal" id="ch_semanal" value="{{ $model->ch_semanal }}">
                    @error('ch_semanal')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mt-1 text-end">
                @include('components.buttons.btn-close_modal')

                @include('components.buttons.btn-save', [
                    'content' => 'Cadastrar'
                ])
            </div>
            
        </form>
    </div>

</div>