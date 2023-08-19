{{-- 
    @var $model App\Models\Tabelas\Ensino\EnsinoParticipacao
--}}

<div class="my-4 mx-2">

    <div class="card">
        <div class="card-header">
            Ensino - Participação
        </div>
        <div class="card-body">
            <h5><span class="fw-bolder">Cód Atividade: </span> {{ $model->cod_atividade }}</h5>
            <p> <span class="fw-bolder">Nome do Curso: </span> {{ $model->curso }} </p>
            <p> <span class="fw-bolder">Nível do Curso: </span> {{ $model->nivelToString() }} </p>
            <p> <span class="fw-bolder">C.H Semanal: </span> {{ $model->ch_semanal . 'h' }} </p>
        </div>
        <div class="card-footer">
            <h5 class="fw-bolder">Correções</h5>
            <p> <span class="fw-bolder">Descrição: </span> {{ $model->avaliacao->descricao }} </p>
            <p> <span class="fw-bolder">C.H Reajuste: </span> {{ $model->avaliacao->horas_reajuste . 'h'}} </p>
        </div>
    </div>

</div>