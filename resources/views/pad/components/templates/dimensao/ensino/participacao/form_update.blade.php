
<div id="ensino_participacao">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Participação </h3 class="h3">
        </div>
        <form action="{{route('ensino_participacao_update', ['id' => $model->id])}}" method="post" id="ensino_participacao_update-form" class="">
            @csrf
        
            <div class="row">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" value="{{$model->cod_atividade}}" readonly>
                </div>

                <div class="mb-3 col-sm-10">
                    <label class="form-label" for="curso">Nome do Curso</label>
                    <input class="form-control @error('curso') is-invalid @enderror ajax-errors" type="text" name="curso" id="curso" value="{{ $model->curso }}">
                    
                    @include('components.divs.errors', [
                        'field' => 'curso_update'
                    ])
                </div>

                <div class="mb-3 col-sm-6">
                    <label class="form-label" for="nivel">Nível do Curso</label>
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
                        'field' => 'nivel_update'
                    ])
                </div>

                <div class="mb-3 col-sm-6">
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
                        'id' => 'btn-submit_ensino_participacao-update',
                        'content' => 'Atualizar',
                    ])
                </div>
            </div>
            
        </form>
    </div>

</div>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_ensino_participacao-update',
    'form_id' => 'ensino_participacao_update-form',
    'form_type' => 'update',
    'route' => route('ensino_participacao_validate'),
])