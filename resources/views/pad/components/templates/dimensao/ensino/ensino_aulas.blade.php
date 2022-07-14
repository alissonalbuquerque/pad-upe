
<div id="ensino_aulas">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Aulas </h3 class="h3">
        </div>
        <form action="{{route('ensino_aula_create')}}" method="post" id="ensino_aulas-form" class="">
            @csrf
        
            <div class="row">
                
                <input type="hidden" name="user_pad_id" value="{{$user_pad_id}}">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control @error('cod_atividade') is-invalid @enderror" type="text" name="cod_atividade" id="cod_atividade" readonly>
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="componente_curricular">Componente Curricular</label>
                    <input class="form-control @error('componente_curricular') is-invalid @enderror" type="text" name="componente_curricular" id="componente_curricular" value="{{ old('componente_curricular') }}">
                    @error('componente_curricular')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="curso">Curso</label>
                    <input class="form-control @error('curso') is-invalid @enderror" type="text" name="curso" id="curso" value="{{ old('curso') }}">
                    @error('curso')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="nivel">Nível</label>
                    <select class="form-select @error('nivel') is-invalid @enderror" name="nivel" id="nivel" value="{{ old('nivel') }}">
                        <option value="0">Selecione um Nível</option>
                        @foreach($niveis as $value => $nivel)
                            @if( $value == old('nivel') )
                                <option selected value="{{$value}}">{{$nivel}}</option>
                            @else
                                <option value="{{$value}}">{{$nivel}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('nivel')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="modalidade">Modalidade</label>
                    <select class="form-select @error('modalidade') is-invalid @enderror" name="modalidade" id="modalidade" value="{{ old('modalidade') }}">
                        <option value="0">Selecione uma Modalidade</option>
                        @foreach($modalidades as $value => $modalidade)
                            @if( $value == old('modalidade') )
                                <option selected value="{{$value}}">{{$modalidade}}</option>
                            @else
                                <option value="{{$value}}">{{$modalidade}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('modalidade')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="ch_semanal">CH. Semanal</label>
                    <input class="form-control @error('ch_semanal') is-invalid @enderror" type="number" name="ch_semanal" id="ch_semanal" value="{{ old('ch_semanal') }}">
                    @error('ch_semanal')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="ch_total">CH. Total</label>
                    <input class="form-control @error('ch_total') is-invalid @enderror" type="number" name="ch_total" id="ch_total" value="{{ old('ch_total') }}">
                    @error('ch_total')
                        <div class="alert alert-danger">
                            <span>{{$message}}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mt-1 text-end">
                <button type="submit" class="btn btn-success rounded">Cadastrar</button>
            </div>
            
        </form>
    </div>

    <div class="mt-4">
        @include('pad.components.templates.table', ['table_id' => 'ensino_aulas-table', 'colunas' => ['Cód', 'Componente Curricular', 'Curso', 'Nível', 'Modalidade', 'CH Semanal', 'CH Total', 'Opções']])
    </div>

</div>