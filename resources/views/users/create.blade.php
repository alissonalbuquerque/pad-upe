
@extends('layouts.main')

@section('title', 'Usuários')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', [
        'index_menu' => $menu,
    ])
@endsection

@section('body')

<div class="container">
    
    @include('components.alerts')

    <div class="mb-3">
        <h3 class="h4"> Cadastrar - Usuário </h3>
    </div>

    <form action="{{route('user_store')}}" method="POST">
        @include('users._form', ['model' => $model])
    </form>

</div>

@endsection