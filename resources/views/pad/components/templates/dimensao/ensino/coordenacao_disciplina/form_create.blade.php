
<div id="ensino_coordenacao_disciplina" class="">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Coordenação (disciplinas) </h3 class="h3">
        </div>
        <form action="{{-- route('') --}}" method="post" id="ensino_coordenacao_disciplina-form" class="">
            @csrf

            <div class="row">
                
                <input type="hidden" name="user_pad_id" value="{{ $user_pad_id }}">

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control" type="text" name="cod_atividade" id="cod_atividade" disabled readonly>
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="componente_curricular">Componente Curricular</label>
                    <input class="form-control" type="text" name="componente_curricular" id="componente_curricular" value="{{ old('componente_curricular') }}">

                    @include('components.divs.errors', [
                        'form' => 'ensino_coordenacao_disciplina_form_create',
                        'field' => 'componente_curricular',
                    ])
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="curso">Curso</label>
                    <input class="form-control" type="text" name="curso" id="curso" value="{{ old('curso') }}">

                    @include('components.divs.errors', [
                        'form' => 'ensino_coordenacao_disciplina_form_create',
                        'field' => 'curso',
                    ])
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="nivel">Nível</label>
                    <select class="form-select" name="nivel" id="nivel">
                        <option selected value="0">Selecione um Nível</option>
                        <option value="0">Selecione um Nível</option>
                        @foreach($niveis as $value => $nivel)
                            @if( $value == old('nivel') )
                                <option selected value="{{$value}}">{{$nivel}}</option>
                            @else
                                <option value="{{$value}}">{{$nivel}}</option>
                            @endif
                        @endforeach
                    </select>

                    @include('components.divs.errors', [
                        'form' => 'ensino_coordenacao_disciplina_form_create',
                        'field' => 'nivel',
                    ])
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="modalidade">Modalidade</label>
                    <select class="form-select" name="modalidade" id="modalidade">
                    <option value="0">Selecione uma Modalidade</option>
                    @foreach($modalidades as $value => $modalidade)
                        @if( $value == old('modalidade') )
                            <option selected value="{{$value}}">{{$modalidade}}</option>
                        @else
                            <option value="{{$value}}">{{$modalidade}}</option>
                        @endif
                    @endforeach
                    </select>

                    @include('components.divs.errors', [
                        'form' => 'ensino_coordenacao_disciplina_form_create',
                        'field' => 'modalidade',
                    ])
                </div>

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="ch_semanal">CH. Semanal</label>
                    <input class="form-control" type="number" name="ch_semanal" id="ch_semanal">

                    @include('components.divs.errors', [
                        'form' => 'ensino_coordenacao_disciplina_form_create',
                        'field' => 'ch_semanal',
                    ])
                </div>
            </div>

            <div class="mt-1 text-end">
                @include('components.buttons.btn-save', [
                    'id' => '',
                    'content' => 'Cadastrar',
                ])
            </div>
            
        </form>
    </div>

    <div class="border rounded px-4 mt-4">

        <table class="table table-hover" id="ensino_aulas-table-">
            <thead>
                <tr>
                    <!-- <th scole="col">#</th> -->
                    <th scope="col"> Cód </th>
                    <th scope="col"> Componente Curricular </th>
                    <th scope="col"> Curso </th>
                    <th scope="col"> Nível </th>
                    <th scope="col"> Modalidade </th>
                    <th scope="col"> CH Semanal </th>
                    <th scope="col"> Opções </th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($ensinoCoordenacaoDisciplinas as $ensinoCoordenacaoDisciplina)
                <tr>
                    <td>{{ $ensinoCoordenacaoDisciplina->cod_atividade }}</td>
                    <td>{{ $ensinoCoordenacaoDisciplina->componente_curricular }}</td>
                    <td>{{ $ensinoCoordenacaoDisciplina->curso }}</td>
                    <td>{{ $ensinoCoordenacaoDisciplina->nivelAsString() }}</td>
                    <td>{{ $ensinoCoordenacaoDisciplina->modalidadeAsString() }}</td>
                    <td>{{ $ensinoCoordenacaoDisciplina->ch_semanal }}</td>
                    <td>
                        @include('components.buttons.btn-edit-task', [
                            'btn_class' => 'btn-edit_ensino_coordenacao_disciplina',
                            'btn_id' => $ensinoCoordenacaoDisciplina->id,
                        ])

                        @include('components.buttons.btn-delete', [
                            'id' => $ensinoCoordenacaoDisciplina->id,
                            'route' => route('ensino_coordenacao_disciplina_delete', ['id' => $ensinoCoordenacaoDisciplina->id])
                        ])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>