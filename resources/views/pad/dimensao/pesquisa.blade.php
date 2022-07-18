@extends('layouts.main')

@section('title', 'Pesquisa')
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
    <div class="container">

        @include('pad.components.templates.dropdown-eixo', ['divs' => $divs])

        @include('components.alerts')

        @include('pad.components.templates.dimensao.pesquisa.coordenacao.form_create', ['user_pad_id' => $user_pad_id])

        @include('pad.components.templates.dimensao.pesquisa.lideranca.form_create', ['user_pad_id' => $user_pad_id])

        @include('pad.components.templates.dimensao.pesquisa.orientacao.form_create', ['user_pad_id' => $user_pad_id])

        @include('components.modal', ['size' => 'modal-lg'])
    </div>
@endsection

@section('scripts')
    
    @include('pad.components.scripts.dropdown-eixo', ['divs' => $divs])
    @include('pad.components.scripts.dimensao.pesquisa.general')

    @include('pad.components.scripts.dimensao.pesquisa.coordenacao')

@endsection
