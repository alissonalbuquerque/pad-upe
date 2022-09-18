
<div id="ensino_atendimento_discente">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Atendimento ao Discente </h3>
        </div>
        <form action="{{route('ensino_atendimento_discente_update', ['id' => $model->id])}}" method="post" id="ensino_atendimento_discente_update-form" class="">
            @csrf
        
            <div class="row">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" value="{{$model->cod_atividade}}" readonly>
                </div>

                <div class="mb-3 col-sm-10">
                        <label class="form-label" for="componente_curricular">Componente Curricular</label>
                        <input class="form-control @error('componente_curricular') is-invalid @enderror ajax-errors" type="text" name="componente_curricular" id="componente_curricular" value="{{ $model->componente_curricular }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'componente_curricular_create',
                        ])
                    </div>

                    <div class="mb-3 col-sm-12">
                        <label class="form-label" for="curso">Curso</label>
                        <input class="form-control @error('curso') is-invalid @enderror ajax-errors" type="text" name="curso" id="curso" value="{{ $model->curso }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'curso_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-6">
                        <label class="form-label" for="nivel">Nível</label>
                        <select class="form-select @error('nivel') is-invalid @enderror ajax-errors" name="nivel" id="nivel">
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
                            'field' => 'nivel_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-6">
                        <label class="form-label" for="ch_semanal">CH. Semanal</label>
                        <input class="form-control @error('ch_semanal') is-invalid @enderror ajax-errors" type="number" name="ch_semanal" id="ch_semanal" value="{{ $model->ch_semanal }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'ch_semanal_create'
                        ])
                    </div>

            </div>

            <div class="mt-1 text-end">
                <div class="modal-footer">
                    @include('components.buttons.btn-close_modal')

                    @include('components.buttons.btn-save', [
                        'id' => 'btn-submit_ensino_atendimento_discente-update',
                        'content' => 'Atualizar',
                    ])
                </div>
            </div>
            
        </form>
    </div>

</div>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_ensino_atendimento_discente-update',
    'form_id' => 'ensino_atendimento_discente_update-form',
    'form_type' => 'update',
    'route' => route('ensino_atendimento_discente_validate'),
])