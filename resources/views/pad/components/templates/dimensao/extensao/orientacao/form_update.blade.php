
<div id="extensao_orientacao">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Extensão - Orientação </h3 class="h3">
        </div>
        <form action="{{route('extensao_orientacao_update', ['id' => $model->id])}}" method="post" id="extensao_orientacao_update-form" class="">
            @csrf
        
            <div class="row">
                    
                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" value="{{ $model->cod_atividade }}" readonly>
                </div>

                <div class="mb-3 col-sm-10">
                    <label class="form-label" for="titulo_projeto">Título do Projeto</label>
                    <input class="form-control @error('titulo_projeto') is-invalid @enderror ajax-errors" type="text" name="titulo_projeto" id="titulo_projeto" value="{{ $model->titulo_projeto }}">
                    
                    @include('components.divs.errors', [
                        'field' => 'titulo_projeto_update'
                    ])
                </div>

                <div class="mb-3 col-sm-8">
                    <label class="form-label" for="discente">Nome do Orientando</label>
                    <input class="form-control @error('discente') is-invalid @enderror ajax-errors" type="text" name="discente" id="discente" value="{{ $model->discente }}">
                    
                    @include('components.divs.errors', [
                        'field' => 'discente_update'
                    ])
                </div>

                <div class="mb-3 col-sm-4">
                    <label class="form-label" for="funcao">Função</label>
                    <select class="form-select @error('funcao') is-invalid @enderror ajax-errors" name="funcao" id="funcao">
                        <option value="0">Selecione uma Função</option>
                        @foreach($funcoes as $value => $funcao)
                            @if( $value == $model->funcao )
                                <option selected value="{{$value}}">{{$funcao}}</option>
                            @else
                                <option value="{{$value}}">{{$funcao}}</option>
                            @endif
                        @endforeach
                    </select>

                    @include('components.divs.errors', [
                        'field' => 'funcao_update'
                    ])
                </div>
                
                <div class="mb-3 col-sm-8">
                    <label class="form-label" for="cod_dimensao">Resolução</label>
                    <select class="form-select @error('cod_dimensao') is-invalid @enderror ajax-errors" name="cod_dimensao" id="cod_dimensao" value="{{ old('cod_dimensao') }}">
                        <option value="0">Selecione uma Resolução</option>
                        @foreach($planejamentos as $value => $cod_dimensao)
                            @if( $value == $model->cod_dimensao )
                                <option selected value="{{$value}}">{{$cod_dimensao}}</option>
                            @else
                                <option value="{{$value}}">{{$cod_dimensao}}</option>
                            @endif
                        @endforeach
                    </select>

                    @include('components.divs.errors', [
                        'field' => 'cod_dimensao_update'
                    ])
                </div>

                <div class="mb-3 col-sm-4">
                    <label class="form-label" for="ch_semanal">CH. Semanal</label>
                    <input class="form-control @error('ch_semanal') is-invalid @enderror ajax-errors" type="number" name="ch_semanal" id="ch_semanal" value="{{ $model->ch_semanal }}">
                    
                    @include('components.divs.errors', [
                        'field' => 'ch_semanal_update'
                    ])
                </div>

            </div>

            <div class="mt-1 text-end">
                <div class="modal-footer">
                    @include('components.buttons.btn-close_modal')

                    @include('components.buttons.btn-save', [
                        'id' => 'btn-submit_extensao_orientacao-update',
                        'content' => 'Atualizar',
                    ])
                </div>
            </div>
            
        </form>
    </div>

</div>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_extensao_orientacao-update',
    'form_id' => 'extensao_orientacao_update-form',
    'form_type' => 'update',
    'route' => route('extensao_orientacao_validate'),
])