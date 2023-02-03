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

<div class="mx-2">
    <h3 class="h3"> DIMENSÕES </h3>
</div>

<div class="d-flex my-3">

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-mortarboard-fill"></i> </h2>
            <h3 class="text-center">Ensino</h3>
            <div class="text-center">
                <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $ensinoTotalHoras }}</span> </h4>
            </div>
            <a class="stretched-link" href="{{ route('dimensao_ensino', ['user_pad_id' => $user_pad_id]) }}" class="btn-pad-dimensao"></a>
        </div>     
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-search"></i> </h2>
            <h3 class="text-center">Pesquisa</h3>
            <div class="text-center">
                <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $pesquisaTotalHoras }}</span> </h4>
            </div>
            <a class="stretched-link" href="{{ route('dimensao_pesquisa', ['user_pad_id' => $user_pad_id]) }}" class="btn-pad-dimensao"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-clipboard-data-fill"></i> </h2>
            <h3 class="text-center">Extensão</h3>
            <div class="text-center">
                <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $extensaoTotalHoras }}</span> </h4>
            </div>
            <a class="stretched-link" href="{{ route('dimensao_extensao', ['user_pad_id' => $user_pad_id]) }}" class="btn-pad-dimensao"></a>
        </div>
    </div>

    <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-people-fill"></i> </h2>
            <h3 class="text-center">Gestão</h3>
            <div class="text-center">
                <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $gestaoTotalHoras }}</span> </h4>
            </div>
            <a class="stretched-link" href="{{ route('dimensao_gestao', ['user_pad_id' => $user_pad_id]) }}" class="btn-pad-dimensao"></a>
        </div>
    </div>

</div>

<div class="mx-2">
    <div class="mb-3">
        <!-- <h3 class="h3"> ANEXOS </h3> -->
    </div>
</div>

<div class="d-flex my-2">

    <!-- <div class="card mx-2" style="width: 10rem;">
        <div class="card-body">
            <h2 class="text-center"> <i class="bi bi-file-earmark-text-fill"></i> </h2>
            <h3 class="text-center"> Anexo B </h3>
            <a class="stretched-link" href="{{-- route('') --}}" class="btn-pad-dimensao"></a>
        </div>
    </div> -->

</div>
@endsection
