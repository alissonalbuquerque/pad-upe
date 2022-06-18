
<div id="ensino_coordenacao_disciplina" class="">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Coordenação (disciplinas) </h3 class="h3">
        </div>
        <form action="{{-- route('') --}}" method="post" id="ensino_coordenacao_disciplina-form" class="">
            @csrf

            <div class="row">
                
                <input type="hidden" name="pad_id" value={{1}}>

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control" type="text" name="cod_atividade" id="cod_atividade" disabled readonly>
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="componente_curricular">Componente Curricular</label>
                    <input class="form-control" type="text" name="componente_curricular" id="componente_curricular">
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="curso">Curso</label>
                    <input class="form-control" type="text" name="curso" id="curso">
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="nivel">Nível</label>
                    <select class="form-select" name="nivel" id="nivel">
                        <option selected value="0">Selecione um Nível</option>
                        @foreach($niveis as $value => $nivel)
                            <option value="{{$value}}">{{$nivel}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="modalidade">Modalidade</label>
                    <select class="form-select" name="modalidade" id="modalidade">
                        <option selected value="0">Selecione uma Modalidade</option>
                        @foreach($modalidades as $value => $modalidade)
                            <option value="{{$value}}">{{$modalidade}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="ensino_aulas-ch_semanal">CH. Semanal</label>
                    <input class="form-control" type="number" name="ensino_aulas-ch_semanal" id="ensino_aulas-ch_semanal">
                </div>
            </div>

            <div class="mt-1 text-end">
                <button type="submit" class="btn btn-success rounded">Cadastrar</button>
            </div>
            
        </form>
    </div>

    <div class="" id="">
        @include('pad.components.templates.table', ['table_id' => 'ensino_coordenacao_disciplina-table'])
    </div>

</div>