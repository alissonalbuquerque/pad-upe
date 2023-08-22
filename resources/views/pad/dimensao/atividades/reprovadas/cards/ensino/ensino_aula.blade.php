{{-- 
    @var $model App\Models\Avaliacao
--}}

<div class="my-4 mx-2">

    <div class="card">
        <div class="card-header">
            Ensino - Aula
        </div>
        <div class="card-body">
            <h5><span class="fw-bolder">Cód Atividade: </span> {{ $model->tarefa->cod_atividade }}</h5>
            <p> <span class="fw-bolder">Componente Curricular: </span> {{ $model->tarefa->componente_curricular }} </p>
            <p> <span class="fw-bolder">Curso: </span> {{ $model->tarefa->curso }} </p>
            <p> <span class="fw-bolder">Nível: </span> {{ $model->tarefa->nivelToString() }} </p>
            <p> <span class="fw-bolder">Modalidade: </span> {{ $model->tarefa->modalidadeToString() }} </p>
            <p> <span class="fw-bolder">C.H Semanal: </span> {{ $model->tarefa->ch_semanal . 'h' }} </p>
        </div>
        <div class="card-footer">
            <h5 class="fw-bolder">Correções</h5>
            <p> <span class="fw-bolder">Descrição: </span> {{ $model->descricao }} </p>
            <p> <span class="fw-bolder">C.H Reajuste: </span> {{ $model->horas_reajuste . 'h'}} </p>
        </div>
    </div>

</div>