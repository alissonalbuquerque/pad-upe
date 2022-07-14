
<div id="ensino_orientacao" class="">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Orientação </h3 class="h3">
        </div>
        <form action="{{-- route('') --}}" method="post" id="ensino_orientacao-form" class="">
            @csrf

            <div class="row">
                
                <input type="hidden" name="pad_id" value={{1}}>

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control" type="text" name="cod_atividade" id="cod_atividade" disabled readonly>
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="atividade">Atividade: Orientação / Coorientação </label>
                    <input class="form-control" type="text" name="atividade" id="atividade">
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
                    <label class="form-label" for="ensino_orientacao-categoria"> Categoria </label>
                    <select class="form-select" name="categoria" id="ensino_orientacao-categoria">
                        <option selected value="0">Selecione uma Categoria </option>
                        @foreach($categorias as $value => $categoria)
                            <option value="{{$value}}">{{$categoria}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3 col-sm-2" id="container_ensino_orientacao-numero_individuos">
                    <label class="form-label" for="ensino_orientacao-numero_individuos">Nº Individuos</label>
                    <input class="form-control" type="number" name="numero_individuos" id="ensino_orientacao-numero_individuos">
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
        @include('pad.components.templates.table', ['table_id' => 'ensino_orientacao-table', 'colunas' => ['Cód', ]])
    </div>

</div>