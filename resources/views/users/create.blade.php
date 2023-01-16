
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

    @include('users._form', [
        'action' => route('user_store'),
        'model' => $model,
    ])

</div>

@endsection