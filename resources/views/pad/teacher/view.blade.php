@extends('layouts.main')

@php
    use App\Models\Tabelas\Constants;
@endphp

@section('title', 'Unidade')
@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection
@section('nav')
    @include('layouts.navigation', [
        'menu' => $menu,
    ])
@endsection
@section('body')

<div class="mx-2 d-flex  justify-content-between">
    <h3 class="h3"> DIMENSÕES </h3>
    <button class="btn btn-outline-success btn-m btn-save_pad" style="margin-right: 1.2rem">
        <i class="bi bi-check-square"></i>
        Enviar PAD
    </button>
</div>

<div class="d-flex my-3">

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-mortarboard-fill"></i> </h2>
            <h3 class="text-center">Ensino</h3>
            <div class="text-center">
                <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $ensinoTotalHoras }}</span> </h4>
            </div>
            <a class="stretched-link btn-pad-dimensao" href="{{ route('dimensao_ensino', ['user_pad_id' => $user_pad_id]) }}"></a>
        </div>     
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-search"></i> </h2>
            <h3 class="text-center">Pesquisa</h3>
            <div class="text-center">
                <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $pesquisaTotalHoras }}</span> </h4>
            </div>
            <a class="stretched-link btn-pad-dimensao" href="{{ route('dimensao_pesquisa', ['user_pad_id' => $user_pad_id]) }}"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-clipboard-data-fill"></i> </h2>
            <h3 class="text-center">Extensão</h3>
            <div class="text-center">
                <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $extensaoTotalHoras }}</span> </h4>
            </div>
            <a class="stretched-link btn-pad-dimensao" href="{{ route('dimensao_extensao', ['user_pad_id' => $user_pad_id]) }}"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-people-fill"></i> </h2>
            <h3 class="text-center">Gestão</h3>
            <div class="text-center">
                <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $gestaoTotalHoras }}</span> </h4>
            </div>
            <a class="stretched-link btn-pad-dimensao" href="{{ route('dimensao_gestao', ['user_pad_id' => $user_pad_id]) }}"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-clock"></i> </h2>
            <h3 class="text-center">Horário</h3>
            <a class="stretched-link btn-pad-horario" href="{{ route('TaskTimeIndex', ['user_pad_id' => $user_pad_id]) }}"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-exclamation-circle-fill"></i> </h2>
            <h3 class="text-center"> Reprovadas </h3>
            <a class="stretched-link" href="{{ route('tasks_disapproved', ['user_pad_id' => $user_pad_id]) }}" class="btn-pad-dimensao"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-file-earmark-text-fill"></i> </h2>
            <h3 class="text-center"> Anexo B </h3>
            <a class="stretched-link" href="{{ route('edit_anexo', ['user_pad_id' => $user_pad_id]) }}" class="btn-pad-dimensao"></a>
        </div>
    </div>
</div>

<div class="d-flex my-3">
    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body bg-primary">
            <h1 class="text-center"> <i class="bi bi-cloud-arrow-down-fill" style="color: #F1F1F1"></i> </h1>
            <h5 class="text-center text-white"> Baixar PAD </h4>
            <div class="text-center">
                <h4 class="h5"> <span class="badge" style="color: #32415c;background-color: #fd9d0d">Horas: {{ $ensinoTotalHoras + $gestaoTotalHoras + $pesquisaTotalHoras + $extensaoTotalHoras }}</span> </h4>
            </div>
            <a class="stretched-link btn-pdf-download" href="{{ route('user-pad_pdf', ['user_pad_id' => $user_pad_id]) }}"></a>
        </div>
    </div>
</div>

@include('components.modal', [
    'size' => 'modal-lg',
    'header' => 'Salvar PAD?'
])
@endsection

@section('scripts')
    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('user-pad_save', ['user_pad_id' => $user_pad_id]),
        'btn_class' => 'btn-save_pad',
    ])
@endsection