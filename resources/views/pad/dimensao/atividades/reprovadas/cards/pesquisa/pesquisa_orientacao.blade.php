{{-- 
    @var $model App\Models\Tabelas\Pesquisa\PesquisaOrientacao
--}}

<style>
    .bolded { 
        font-weight: bold;
    }
</style>

<div class="my-4 mx-2">

    <div class="card">
        <div class="card-header">
            Pesquisa - Orientação
        <div class="card-body">
            <h5><span class="bolded">Cód Atividade: </span> {{ $model->cod_atividade }}</h5>
            <p> <span class="bolded">Nome do Orientando: </span> {{ $model->nome_orientando }} </p>
            <p> <span class="bolded">Título do Projeto: </span> {{ $model->titulo_projeto }} </p>
            <p> <span class="bolded">Função: </span> {{ $model->funcaoToString() }} </p>
            <p> <span class="bolded">C.H Semanal: </span> {{ $model->ch_semanal . 'h' }} </p>
        </div>
        <div class="card-footer">
            <h5 class="bolded">Correções</h5>
            <p> <span class="bolded">Descrição: </span> {{ $model->avaliacao->descricao }} </p>
            <p> <span class="bolded">C.H Reajuste: </span> {{ $model->avaliacao->horas_reajuste . 'h'}} </p>
        </div>
    </div>

</div>