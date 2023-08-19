{{-- 
    @var $model App\Models\Tabelas\Gestao\GestaoMembroTitularConselho
    
--}}

<style>
    .bolded { 
        font-weight: bold;
    }
</style>

<div class="my-4 mx-2">

    <div class="card">
        <div class="card-header">
            Gestão - Membro Titular dos Conselhos da UPE
        <div class="card-body">
            <h5><span class="bolded">Cód Atividade: </span> {{ $model->cod_atividade }}</h5>

            <p> <span class="bolded">Nome do Conselho: </span> {{ $model->nome }} </p>
            <p> <span class="bolded">Documento que o Designa: </span> {{ $model->documento }} </p>
            <p> <span class="bolded">C.H Semanal: </span> {{ $model->ch_semanal . 'h' }} </p>
        </div>
        <div class="card-footer">
            <h5 class="bolded">Correções</h5>
            <p> <span class="bolded">Descrição: </span> {{ $model->avaliacao->descricao }} </p>
            <p> <span class="bolded">C.H Reajuste: </span> {{ $model->avaliacao->horas_reajuste . 'h'}} </p>
        </div>
    </div>

</div>