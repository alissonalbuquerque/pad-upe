{{-- 
    @var $model App\Models\Tabelas\Pesquisa\PesquisaCoordenacao
--}}

<div class="my-4 mx-2">

    <div class="card">
        <div class="card-header">
            Pesquisa - Coordenação
        </div>
        <div class="card-body">
            <h5><span class="fw-bolder">Cód Atividade: </span> {{ $model->cod_atividade }}</h5>
            <p> <span class="fw-bolder">Título do Projeto: </span> {{ $model->titulo_projeto }} </p>
            <p> <span class="fw-bolder">Função: </span> {{ $model->funcaoToString() }} </p>
            <p> <span class="fw-bolder">Linha e Grupo de Pesquisa: </span> {{ $model->linha_grupo_pesquisa }} </p>            
            <p> <span class="fw-bolder">C.H Semanal: </span> {{ $model->ch_semanal . 'h' }} </p>
        </div>
        <div class="card-footer">
            <h5 class="fw-bolder">Correções</h5>
            <p> <span class="fw-bolder">Descrição: </span> {{ $model->avaliacao->descricao }} </p>
            <p> <span class="fw-bolder">C.H Reajuste: </span> {{ $model->avaliacao->horas_reajuste . 'h'}} </p>
        </div>
    </div>

</div>