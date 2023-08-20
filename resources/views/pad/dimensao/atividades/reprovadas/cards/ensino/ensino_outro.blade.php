{{-- 
    @var $model App\Models\Tabelas\Ensino\EnsinoOutros
--}}

<div class="my-4 mx-2">

    <div class="card">
        <div class="card-header">
            Ensino - Outros
        </div>
        <div class="card-body">
            <h5><span class="fw-bolder">Cód Atividade: </span> {{ $model->cod_atividade }}</h5>
            <p> <span class="fw-bolder">Atividade ( Nome da Atividade Realizada ): </span> {{ $model->atividade }} </p>
            <p> <span class="fw-bolder">Atividade ( Descrição ): </span> {{ $model->descricao }} </p>
            <p> <span class="fw-bolder">C.H Semanal: </span> {{ $model->ch_semanal . 'h' }} </p>
        </div>
        <div class="card-footer">
            @if($model->avaliacao)
                <h5 class="fw-bolder">Correções</h5>
                <p> <span class="fw-bolder">Descrição: </span> {{ $model->avaliacao->descricao }} </p>
                <p> <span class="fw-bolder">C.H Reajuste: </span> {{ $model->avaliacao->horas_reajuste }} </p>
            @endif
        </div>
    </div>

</div>