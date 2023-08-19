{{-- 
    @var $model App\Models\Tabelas\Ensino\EnsinoOrientacao
--}}

@php
    use App\Models\Util\Orientacao;
@endphp

<div class="my-4 mx-2">

    <div class="card">
        <div class="card-header">
            Ensino - Orientações
        </div>
        <div class="card-body">
            <h5><span class="fw-bolder">Cód Atividade: </span> {{ $model->cod_atividade }}</h5>
            <p> <span class="fw-bolder">Atividade: Orientação e/ou Coorientação: </span> {{ $model->atividade }} </p>
            <p> <span class="fw-bolder">Curso: </span> {{ $model->curso }} </p>
            <p> <span class="fw-bolder">Nível: </span> {{ $model->nivelToString() }} </p>
            <p> <span class="fw-bolder">Orientação: </span> {{ $model->orientacaoToString() }} </p>
            @if($model->type_orientacao == Orientacao::GRUPO)
                <p> <span class="fw-bolder">Número de Orientandos: </span> {{ $model->numero_orientandos }} </p>
            @endif
            <p> <span class="fw-bolder">C.H Semanal: </span> {{ $model->ch_semanal . 'h' }} </p>
        </div>
        <div class="card-footer">
            <h5 class="fw-bolder">Correções</h5>
            <p> <span class="fw-bolder">Descrição: </span> {{ $model->avaliacao->descricao }} </p>
            <p> <span class="fw-bolder">C.H Reajuste: </span> {{ $model->avaliacao->horas_reajuste . 'h'}} </p>
        </div>
    </div>

</div>