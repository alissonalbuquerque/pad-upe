
<div id="ensino_participacao" class="">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Participação </h3 class="h3">
        </div>
        <form action="{{--route('')--}}" method="post" id="ensino_participacao-form" class="">
            @csrf

            <div class="row">
                
                <input type="hidden" name="pad_id" value={{1}}>

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control" type="text" name="cod_atividade" id="cod_atividade" disabled readonly>
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="curso">Nome do Curso</label>
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

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="ch_semanal">CH. Semanal</label>
                    <input class="form-control" type="number" name="ch_semanal" id="ch_semanal">
                </div>
            </div>

            <div class="mt-1 text-end">
                <button type="submit" class="btn btn-success rounded">Cadastrar</button>
            </div>
            
        </form>
    </div>

    <div class="" id="">
        @include('pad.components.templates.table', ['table_id' => 'ensino_aulas-table', 'colunas' => ['Cód', ]])
    </div>

</div>