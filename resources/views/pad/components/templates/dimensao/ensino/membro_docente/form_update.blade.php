
<div id="ensino_membro_docente">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Membro Docente </h3 class="h3">
        </div>
        <form action="{{route('ensino_membro_docente_update', ['id' => $model->id])}}" method="post" id="ensino_membro_docente_update-form" class="">
            @csrf

            <div class="row">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" value="{{$model->cod_atividade}}" readonly>
                </div> 

                <div class="mb-3 col-sm-10">
                    <label class="form-label" for="nucleo">Nome do núcleo docente estruturante / estruturante assistencial</label>
                    <input class="form-control @error('nucleo') is-invalid @enderror ajax-errors" type="text" name="nucleo" id="nucleo" value="{{ $model->nucleo }}">
                    
                    @include('components.divs.errors', [
                        'field' => 'nucleo_update'
                    ])
                </div>

                <div class="mb-3 col-sm-12">
                    <label class="form-label" for="documento">Documento que o designa (Portaria, Ordem de serviço ou Outro)</label>
                    <input class="form-control @error('documento') is-invalid @enderror ajax-errors" type="text" name="documento" id="documento" value="{{ $model->documento }}">
                    
                    @include('components.divs.errors', [
                        'field' => 'documento_update'
                    ])
                </div>
                
                <div class="mb-3 col-sm-6">
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
                        'id' => 'btn-submit_ensino_membro_docente-update',
                        'content' => 'Atualizar',
                    ])
                </div>
            </div>
            
        </form>
    </div>

</div>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_ensino_membro_docente-update',
    'form_id' => 'ensino_membro_docente_update-form',
    'form_type' => 'update',
    'route' => route('ensino_membro_docente_validate'),
])