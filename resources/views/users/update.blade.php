
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
        <h3 class="h4"> Atualizar - Usuário </h3>
    </div>

    @include('users._form', [
        'action' => route('user_update', ['id' => $model->id]),
        'model' => $model,
        'status' => $status,
        'profiles' => $profiles,
    ])

    @include('components.modal', [
        'size' => 'modal-lg',
    ])
</div>

@endsection

@section('scripts')

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('user-type_create', ['user_id' => $model->id]),
        'btn_class' => 'user-type-create',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('user-type_edit'),
        'btn_class' => 'btn-edit_user_type',
    ])

@endsection