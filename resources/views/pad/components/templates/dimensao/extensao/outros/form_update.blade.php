
<div id="extensao_outros">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Extensão - Outros </h3>
        </div>
        <form action="{{route('extensao_outros_update', ['id' => $model->id])}}" method="post" id="extensao_outros_update-form">
            @csrf
        
            <div class="row">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" value="{{$model->cod_atividade}}" readonly>
                </div>

                <div class="mb-3 col-sm-10">
                    <label class="form-label" for="atividade">Atividade ( Nome da Atividade Realizada )</label>
                    <input class="form-control @error('atividade') is-invalid @enderror ajax-errors" type="text" name="atividade" id="atividade" value="{{ $model->atividade }}">
                    
                    @include('components.divs.errors', [
                        'field' => 'atividade_update',
                    ])
                </div>

                <div class="mb-3 col-">
                    <div class="form-group">
                        <textarea class="form-control @error('descricao') is-invalid @enderror ajax-errors" name="descricao" id="atividade" cols="30" rows="5" placeholder="Atividade: Informar/descrever a(s) atividade(s) desenvolvida(s)">{{ $model->descricao }}</textarea>
                    </div>
                    
                    @include('components.divs.errors', [
                        'field' => 'descricao_update'
                    ])
                </div>
                
                <div class="d-flex justify-content-end">
                    <div class="mb-3 col-sm-4">
                        <label class="form-label" for="ch_semanal">CH. Semanal</label>
                        <input class="form-control @error('ch_semanal') is-invalid @enderror ajax-errors" type="number" name="ch_semanal" id="ch_semanal" value="{{$model->ch_semanal}}">
                        
                        @include('components.divs.errors', [
                            'field' => 'ch_semanal_update',
                        ])
                    </div>
                </div>
            </div>

            <div class="mt-1 text-end">
                <div class="modal-footer">
                    @include('components.buttons.btn-close_modal')

                    @include('components.buttons.btn-save', [
                        'id' => 'btn-submit_extensao_outros-update',
                        'content' => 'Atualizar',
                    ])
                </div>
            </div>
            
        </form>
    </div>

</div>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_extensao_outros-update',
    'form_id' => 'extensao_outros_update-form',
    'form_type' => 'update',
    'route' => route('extensao_outros_validate'),
])