
<div id="ensino_aulas">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Aulas </h3 class="h3">
        </div>
        <form action="{{route('ensino_aula_update', ['id' => $model->id])}}" method="post" id="ensino_aulas_update-form" class="">
            @csrf
        
            <div class="row">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror" type="text" name="cod_atividade" id="cod_atividade" value="{{$model->cod_atividade}}" readonly>
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="componente_curricular">Componente Curricular</label>
                    <input class="form-control @error('componente_curricular') is-invalid @enderror" type="text" name="componente_curricular" id="componente_curricular" value="{{$model->componente_curricular}}">
                    
                    @include('components.divs.errors', [
                        'form' => 'ensino_aulas_form_update',
                        'field' => 'componente_curricular',
                    ])

                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="curso">Curso</label>
                    <input class="form-control @error('curso') is-invalid @enderror" type="text" name="curso" id="curso" value="{{$model->curso}}">
                    
                    @include('components.divs.errors', [
                        'form' => 'ensino_aulas_form_update',
                        'field' => 'curso',
                    ])
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="nivel">Nível</label>
                    <select class="form-select @error('nivel') is-invalid @enderror" name="nivel" id="nivel" value="{{ old('nivel') }}">
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
                        'form' => 'ensino_aulas_form_update',
                        'field' => 'nivel',
                    ])
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="modalidade">Modalidade</label>
                    <select class="form-select @error('modalidade') is-invalid @enderror" name="modalidade" id="modalidade">
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
                        'form' => 'ensino_aulas_form_update',
                        'field' => 'modalidade',
                    ])
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="ch_semanal">CH. Semanal</label>
                    <input class="form-control @error('ch_semanal') is-invalid @enderror" type="number" name="ch_semanal" id="ch_semanal" value="{{$model->ch_semanal}}">
                    
                    @include('components.divs.errors', [
                        'form' => 'ensino_aulas_form_update',
                        'field' => 'ch_semanal',
                    ])
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="ch_total">CH. Total</label>
                    <input class="form-control @error('ch_total') is-invalid @enderror" type="number" name="ch_total" id="ch_total" value="{{$model->ch_total}}">

                    @include('components.divs.errors', [
                        'form' => 'ensino_aulas_form_update',
                        'field' => 'ch_total',
                    ])
                </div>
            </div>

            <div class="mt-1 text-end">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn-submit_ensino_aulas-update" class="btn btn-success rounded">Atualizar</button>
                    
                </div>
            </div>
            
        </form>
    </div>

</div>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_ensino_aulas-update',
    'form_id' => 'ensino_aulas_update-form',
    'route' => route('ensino_aula_validate'),
    'div_errors' => 'ensino_aulas_form_update',
])