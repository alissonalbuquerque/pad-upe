
<div id="ensino_supervisao">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Supervisão </h3>
        </div>
        <form action="{{route('ensino_supervisao_update', ['id' => $model->id])}}" method="post" id="ensino_supervisao_update-form" class="">
            @csrf
        
            <div class="row">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" value="{{$model->cod_atividade}}" readonly>
                </div>

            </div>

            <div class="mt-1 text-end">
                <div class="modal-footer">
                    @include('components.buttons.btn-close_modal')

                    @include('components.buttons.btn-save', [
                        'id' => 'btn-submit_ensino_supervisao-update',
                        'content' => 'Atualizar',
                    ])
                </div>
            </div>
            
        </form>
    </div>

</div>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_ensino_supervisao-update',
    'form_id' => 'ensino_supervisao_update-form',
    'form_type' => 'update',
    'route' => route('ensino_supervisao_validate'),
])