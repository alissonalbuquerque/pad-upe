{{-- 
    @var $model App\Models\Avaliacao
--}}

<div class="my-4 mx-2">

    <div class="card">
        <div class="card-header">
            Pesquisa - Orientação
        </div>
        <div class="card-body">
            <h5><span class="fw-bolder">Cód Atividade: </span> {{ $model->tarefa->cod_atividade }}</h5>
            <p> <span class="fw-bolder">Nome do Orientando: </span> {{ $model->tarefa->nome_orientando }} </p>
            <p> <span class="fw-bolder">Título do Projeto: </span> {{ $model->tarefa->titulo_projeto }} </p>
            <p> <span class="fw-bolder">Função: </span> {{ $model->tarefa->funcaoToString() }} </p>
            <p> <span class="fw-bolder">C.H Semanal: </span> {{ $model->tarefa->ch_semanal . 'h' }} </p>
        </div>
        <div class="card-footer">
            <h5 class="fw-bolder">Correções</h5>
            <p> <span class="fw-bolder">Descrição: </span> {{ $model->descricao }} </p>
            <p> <span class="fw-bolder">C.H Reajuste: </span> {{ $model->horas_reajuste . 'h'}} </p>
        </div>
    </div>

</div>