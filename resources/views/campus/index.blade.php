@extends('layouts.main')

@section('title', 'Campus')
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
    @include('components.buttons.btn-create', [
        'route' => route('campus_create'),
        'css' => '',
        'text' => 'Novo Campus',
        'id' => ''
    ])
@endsection
