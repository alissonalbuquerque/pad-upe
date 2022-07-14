
<div id="ensino_coordenacao_docente" class="">
    <div>
        <div class="mb-3">
            <h3 class="h3"> Ensino - Coordenação Docente </h3 class="h3">
        </div>
        <form action="{{--route('')--}}" method="post" id="ensino_coordenacao_docente-form" class="">
            @csrf

            <div class="row">
                
                <input type="hidden" name="pad_id" value={{1}}>

                <div class="mb-3 col-sm-2">
                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                    <input class="form-control" type="text" name="cod_atividade" id="cod_atividade" disabled readonly>
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="nucleo_docente">Núcleo Docente Estruturante / Assistencial</label>
                    <input class="form-control" type="text" name="nucleo_docente" id="nucleo_docente">
                </div>

                <div class="mb-3 col-sm-5">
                    <label class="form-label" for="doc_designador">Documento que o Designa</label>
                    <input class="form-control" type="text" name="doc_designador" id="doc_designador">
                </div>

                <div class="mb-3 col-sm-3">
                    <label class="form-label" for="funcao">Função</label>
                    <select class="form-select" name="funcao" id="funcao">
                        <option selected value="0">Selecione uma Função</option>
                        @foreach($funcoes_ensino as $value => $funcao)
                            <option value="{{$value}}">{{$funcao}}</option>
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
        @include('pad.components.templates.table', ['table_id' => 'ensino_coordenacao_docente-table', 'colunas' => ['Cód', ]])
    </div>

</div>