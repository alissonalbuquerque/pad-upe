
<div id="gestao_representante_unidade_educacao">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Gestão - Representante nas Unidades de Educação ou de Educação e Saúde Formalmente Designado(a) pela Entidade Sindical </h3>
        </div>
        <form action="{{route('gestao_representante_unidade_educacao_update', ['id' => $model->id])}}" method="post" id="gestao_representante_unidade_educacao_update-form">
            @csrf
        
            <div class="row">

                <div class="mb-3 col-sm-3">
                        <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                        <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" value="{{ $model->cod_atividade }}" readonly>
                    </div>

                    <div class="mb-3 col-sm-9">
                        <label class="form-label" for="nome">Documento Comprobatório da Representação Sindical </label>
                        <input class="form-control @error('nome') is-invalid @enderror ajax-errors" type="text" name="nome" id="nome" value="{{ $model->nome }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'nome_update',
                        ])
                    </div>

                    <div class="mb-3 col-sm-9">
                        <label class="form-label" for="documento">Documento que o Designa</label>
                        <input class="form-control @error('documento') is-invalid @enderror ajax-errors" type="text" name="documento" id="documento" value="{{ $model->documento}}">
                        
                        @include('components.divs.errors', [
                            'field' => 'documento_update',
                        ])
                    </div>

                    <div class="mb-3 col-sm-3">
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
                        'id' => 'btn-submit_gestao_representante_unidade_educacao-update',
                        'content' => 'Atualizar',
                    ])
                </div>
            </div>
            
        </form>
    </div>

</div>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_gestao_representante_unidade_educacao-update',
    'form_id' => 'gestao_representante_unidade_educacao_update-form',
    'form_type' => 'update',
    'route' => route('gestao_representante_unidade_educacao_validate'),
])