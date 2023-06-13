
<div id="extensao_coordenacao">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Extenão - Coordenação </h3 class="h3">
        </div>
        <form action="{{route('extensao_coordenacao_update', ['id' => $model->id])}}" method="post" id="extensao_coordenacao_update-form" class="">
            @csrf
        
            <div class="row">

                    <div class="mb-3 col-sm-2">
                        <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                        <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" value="{{$model->cod_atividade}}" readonly>
                    </div>

                    <div class="mb-3 col-sm-10">
                        <label class="form-label" for="programa_extensao">Programa de Extensão</label>
                        <input class="form-control @error('programa_extensao') is-invalid @enderror ajax-errors" type="text" name="programa_extensao" id="programa_extensao" value="{{ $model->programa_extensao }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'programa_extensao_update'
                        ])
                    </div>
                    
                    <div class="mb-3 col-sm-12">
                        <label class="form-label" for="titulo_projeto">Título do Projeto</label>
                        <input class="form-control @error('titulo_projeto') is-invalid @enderror ajax-errors" type="text" name="titulo_projeto" id="titulo_projeto" value="{{ $model->titulo_projeto }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'titulo_projeto_update'
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

                    <div class="mb-3 col-">
                        <div class="form-group">
                            <textarea class="form-control @error('atividade') is-invalid @enderror ajax-errors" name="atividade" id="atividade" cols="30" rows="5" placeholder="Atividade: Informar/descrever a(s) atividade(s) desenvolvida(s)">{{ $model->atividade }}</textarea>
                        </div>
                        
                        @include('components.divs.errors', [
                            'field' => 'atividade_update'
                        ])
                    </div>

            </div>

            <div class="mt-1 text-end">
                <div class="modal-footer">
                    @include('components.buttons.btn-close_modal')

                    @include('components.buttons.btn-save', [
                        'id' => 'btn-submit_extensao_coordenacao-update',
                        'content' => 'Atualizar',
                    ])
                </div>
            </div>
            
        </form>
    </div>

</div>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_extensao_coordenacao-update',
    'form_id' => 'extensao_coordenacao_update-form',
    'form_type' => 'update',
    'route' => route('extensao_coordenacao_validate'),
])