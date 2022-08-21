@extends('layouts.main')

@section('title', 'Extensão')
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

    </div>
@endsection

@section('scripts')
    
    @include('pad.components.scripts.dropdown-eixo', ['divs' => $divs])

@endsection
