{{-- 
    @var $model App\Models\Tabelas\Ensino\EnsinoOrientacao
--}}

@php
    use App\Models\Util\Orientacao;
@endphp

<style>
    .bolded { 
        font-weight: bold;
    }
</style>

<div class="my-4 mx-2">

    <div class="card">
        <div class="card-header">
            Ensino - Orientações
        <div class="card-body">
            <h5><span class="bolded">Cód Atividade: </span> {{ $model->cod_atividade }}</h5>
            <p> <span class="bolded">Atividade: Orientação e/ou Coorientação: </span> {{ $model->atividade }} </p>
            <p> <span class="bolded">Curso: </span> {{ $model->curso }} </p>
            <p> <span class="bolded">Nível: </span> {{ $model->nivelToString() }} </p>
            <p> <span class="bolded">Orientação: </span> {{ $model->orientacaoToString() }} </p>
            @if($model->type_orientacao == Orientacao::GRUPO)
                <p> <span class="bolded">Número de Orientandos: </span> {{ $model->numero_orientandos }} </p>
            @endif
            <p> <span class="bolded">C.H Semanal: </span> {{ $model->ch_semanal . 'h' }} </p>
        </div>
        <div class="card-footer">
            <h5 class="bolded">Correções</h5>
            <p> <span class="bolded">Descrição: </span> {{ $model->avaliacao->descricao }} </p>
            <p> <span class="bolded">C.H Reajuste: </span> {{ $model->avaliacao->horas_reajuste . 'h'}} </p>
        </div>
    </div>

</div>