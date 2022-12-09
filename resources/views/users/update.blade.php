
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

    <form action="{{route('user_update', ['id' => $model->id])}}" method="POST">
        @include('users._form', ['type' => 'update'])
    </form>

</div>

@endsection