
<div id="ensino_aula">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Coordenacao/Regência Componentes Curriculares </h3>
        </div>
        <form action="{{route('ensino_coordenacao_regencia_update', ['id' => $model->id])}}" method="post" id="ensino_coordenacao_regencia_update-form" class="">
            @csrf
        
            <div class="row">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" value="{{$model->cod_atividade}}" readonly>
                </div>

                <div class="mb-3 col-sm-10">
                    <label class="form-label" for="componente_curricular">Componente Curricular</label>
                    <input class="form-control @error('componente_curricular') is-invalid @enderror ajax-errors" type="text" name="componente_curricular" id="componente_curricular" value="{{$model->componente_curricular}}">
                    
                    @include('components.divs.errors', [
                        'field' => 'componente_curricular_update',
                    ])

                </div>

                <div class="mb-3 col-sm-12">
                    <label class="form-label" for="curso">Curso</label>
                    <input class="form-control @error('curso') is-invalid @enderror ajax-errors" type="text" name="curso" id="curso" value="{{$model->curso}}">
                    
                    @include('components.divs.errors', [
                        'field' => 'curso_update',
                    ])
                </div>

                <div class="mb-3 col-sm-6">
                    <label class="form-label" for="nivel">Nível</label>
                    <select class="form-select @error('nivel') is-invalid @enderror ajax-errors" name="nivel" id="nivel" value="{{ old('nivel') }}">
                        <option value="0">Selecione um Nível</option>
                        @foreach($niveis as $value => $nivel)
                            @if( $value == $model->nivel )
                                <option selected value="{{$value}}">{{$nivel}}</option>
                            @else
                                <option value="{{$value}}">{{$nivel}}</option>
                            @endif
                        @endforeach
                    </select>
                    
                    @include('components.divs.errors', [
                        'field' => 'nivel_update',
                    ])
                </div>

                <div class="mb-3 col-sm-6">
                    <label class="form-label" for="modalidade">Modalidade</label>
                    <select class="form-select @error('modalidade') is-invalid @enderror ajax-errors" name="modalidade" id="modalidade">
                        <option value="0">Selecione uma Modalidade</option>
                        @foreach($modalidades as $value => $modalidade)
                            @if( $value == $model->modalidade )
                                <option selected value="{{$value}}">{{$modalidade}}</option>
                            @else
                                <option value="{{$value}}">{{$modalidade}}</option>
                            @endif
                        @endforeach
                    </select>

                    @include('components.divs.errors', [
                        'field' => 'modalidade_update',
                    ])
                </div>

                <div class="mb-3 col-sm-8">
                    <label class="form-label" for="cod_dimensao">Resolução</label>
                    <select class="form-select @error('cod_dimensao') is-invalid @enderror ajax-errors" name="cod_dimensao" id="cod_dimensao" value="{{ old('cod_dimensao') }}">
                        <option value="0">Selecione uma Resolução</option>
                        @foreach($planejamentos as $value => $cod_dimensao)
                            @if( $value == old('cod_dimensao') )
                                <option selected value="{{$value}}">{{$cod_dimensao}}</option>
                            @else
                                <option value="{{$value}}">{{$cod_dimensao}}</option>
                            @endif
                        @endforeach
                    </select>

                    @include('components.divs.errors', [
                        'field' => 'cod_dimensao_create'
                    ])
                </div>

                <div class="mb-3 col-sm-4">
                    <label class="form-label" for="ch_semanal">CH. Semanal</label>
                    <input class="form-control @error('ch_semanal') is-invalid @enderror ajax-errors" type="number" name="ch_semanal" id="ch_semanal" value="{{$model->ch_semanal}}">
                    
                    @include('components.divs.errors', [
                        'field' => 'ch_semanal_update',
                    ])
                </div>
            </div>

            <div class="mt-1 text-end">
                <div class="modal-footer">
                    @include('components.buttons.btn-close_modal')

                    @include('components.buttons.btn-save', [
                        'id' => 'btn-submit_ensino_coordenacao_regencia-update',
                        'content' => 'Atualizar',
                    ])
                </div>
            </div>
            
        </form>
    </div>

</div>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_ensino_coordenacao_regencia-update',
    'form_id' => 'ensino_coordenacao_regencia_update-form',
    'form_type' => 'update',
    'route' => route('ensino_coordenacao_regencia_validate'),
])