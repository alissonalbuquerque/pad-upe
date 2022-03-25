@extends('layouts.main')

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
    <div class="content">
        <div class="header" id="bordcab">
            <h1 class="titulo pt-4 pb-4 mb-3 border-bottom">PLANO DE ATIVIDADES DOCENTES (PAD)</h1>
            <p class="pb-4 mb-3 text-center text-muted align-items-center"><a href="{{ route('pad_anexo') }}">ANEXO B</a>
            </p>
            <p class="pb-4 mb-3 text-center text-muted align-items-center">
                Insira os dados correspondentes nos campos exibidos abaixo
            </p>
        </div>
    </div>
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <a href="{{ route('dimensao_ensino') }}" class="btn-pad-dimensao">
                <i class="bi bi-mortarboard-fill"></i>
                <h2>ENSINO</h2>
            </a>
        </div>
        <div class="btn-group" role="group" aria-label="Third group">
            <a href="{{ route('dimensao_pesquisa') }}" class="btn-pad-dimensao">
                <i class="bi bi-search"></i>
                <h2>PESQUISA</h2>
            </a>
        </div>
        <div class="btn-group mr-2" role="group" aria-label="Second group">
            <a href="{{ route('dimensao_extensao') }}" class="btn-pad-dimensao">
                <i class="bi bi-person-plus-fill"></i>
                <h2>EXTENSÃO</h2>
            </a>
        </div>
        <div class="btn-group" role="group" aria-label="Third group">
            <a href="{{ route('dimensao_gestao') }}" class="btn-pad-dimensao">
                <i class="bi bi-people-fill"></i>
                <h2>GESTÃO</h2>
            </a>
        </div>
    </div>
@endsection
