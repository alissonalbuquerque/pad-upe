@extends('layouts.main')

@section('title', 'Início')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', ['menu' => $menu])
@endsection

@section('body')

<div class="container">

    @include('components.alerts')

    @include('components.buttons.btn-show-modal', [
        // '_id' => 'btn-task-time-create',
        '_class' => 'btn-success',
        '_content' => 'Cadastrar',
        '_target_class' => 'task-time-create',
    ])

    @include('components.modal', ['size' => 'modal-lg', 'header' => ''])

</div>

@endsection

@section('scripts')

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('TaskTimeCreate', ['user_pad_id' => $user_pad_id]),
        'btn_class' => 'task-time-create',
    ])

@endsection