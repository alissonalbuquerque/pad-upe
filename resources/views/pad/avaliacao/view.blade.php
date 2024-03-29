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
        'index_menu' => $index_menu,
    ])
@endsection
@section('body')

<div class="d-flex">

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-mortarboard-fill"></i> </h2>
            <h3 class="text-center">Ensino</h3>
            <a class="stretched-link" href="{{ route('dimensao_ensino', ['user_pad_id' => $user_pad_id]) }}" class="btn-pad-dimensao"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-search"></i> </h2>
            <h3 class="text-center">Pesquisa</h3>
            <a class="stretched-link" href="{{ route('dimensao_pesquisa', ['user_pad_id' => $user_pad_id]) }}" class="btn-pad-dimensao"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-clipboard-data-fill"></i> </h2>
            <h3 class="text-center">Extensão</h3>
            <a class="stretched-link" href="{{ route('dimensao_extensao', ['user_pad_id' => $user_pad_id]) }}" class="btn-pad-dimensao"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-people-fill"></i> </h2>
            <h3 class="text-center">Gestão</h3>
            <a class="stretched-link" href="{{ route('dimensao_gestao', ['user_pad_id' => $user_pad_id]) }}" class="btn-pad-dimensao"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-file-earmark-text-fill"></i> </h2>
            <h3 class="text-center">Anexo</h3>
            <a class="stretched-link" href="{{-- route('') --}}" class="btn-pad-dimensao"></a>
        </div>
    </div>
</div>
@endsection
