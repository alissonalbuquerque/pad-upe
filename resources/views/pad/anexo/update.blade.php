@extends('layouts.main')

@section('title', 'Atualizar Perfil')

@section('header')
@include('layouts.header', [
'user' => Auth::user(),
])
@endsection

@section('nav')
    @include('layouts.navigation', [
        'menu' => $menu
    ])
@endsection

@php
    $user = Auth::user();
@endphp

@section('body')
        
    <div class="container">

        @include('components.alerts')

        <div class="mb-3 mt-3">
            <h3 class="h4 text-center"> Anexo B </h3>
        </div>

        <div>
            @include('pad.anexo._form', [
                'route' => route('update_anexo', ['user_pad_id' => $user_pad_id])
            ])
        </div>
    </div>

@endsection 