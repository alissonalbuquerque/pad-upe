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

        <div class="mb-3">
            <h3 class="h4"> Editar Perfil </h3>
        </div>

        <!-- Tabs -->
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-container" type="button" role="tab" aria-controls="user-container" arial-selected="true"> Usuário </button>
                </li>
                <!-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="paper-tab" data-bs-toggle="tab" data-bs-target="#paper-container" type="button" role="tab" aria-controls="paper-container" arial-selected="false"> Papeis </button>
                </li> -->
            </ul>
        </div>

        <!-- Panels -->
        <div id="tab-containers" class="tab-content">

            <div id="user-container" class="tab-pane fade show active" role="tabpanel" aria-labelledby="user-tab">

                <form class="" method="post" action="{{ route('update_perfil') }}" >    
                    @csrf
                    @method('POST')

                    <div class="border border-rounded mt-2 p-2">

                        <div class="row">
                            <div class="mb-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="name"> Nome </label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nome" value="{{ $user->name }}">
                                    @include('components.divs.errors', ['field' => 'name'])
                                </div>
                            </div>

                            <div class="mb-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="email"> E-Mail </label>
                                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-Mail" value="{{ $user->email }}">
                                    @include('components.divs.errors', ['field' => 'email'])
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-1 text-end">
                        <div class="modal-footer">
                            @include('components.buttons.btn-save', ['content' => 'Atualizar'])

                            @include('components.buttons.btn-cancel', ['content' => 'Cancelar', 'route' => route('dashboard')])
                        </div>
                    </div>
                </form>
            </div>


            <div id="paper-container" class="tab-pane fade" role="tabpanel" aria-labelledby="paper-tab">
                <form method="post" action="{{ route('update_password') }}">
                    @csrf
                    @method('POST')
                    
                    <div class="border border-rounded mt-2 p-2">
                        <div class="row">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="password"> Senha </label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                                        <small id="password_information" class="form-text text-muted"> {{-- --}} </small>
                                        @error('password')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="password_confirmation"> Confirmar Senha </label>
                                        <input type="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Senha">
                                        <small id="password_confirmation_information" class="form-text text-muted"> {{-- --}} </small>
                                        @error('password_confirmation')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-1 text-end">
                        <div class="modal-footer">
                            @include('components.buttons.btn-save', ['content' => 'Atualizar'])

                            @include('components.buttons.btn-cancel', ['content' => 'Cancelar', 'route' => route('dashboard')])
                        </div>
                    </div>
                </form>
            </div>
            
        </div>

    </div>

@endsection 
