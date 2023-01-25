@extends('layouts.main')

@section('title', 'Atulizar Perfil')

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

@include('components.alerts')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> Atualizar Perfil </h1>
</div>

<div class="content">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Home</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Profile</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form class="" method="post" action="{{ route('update_perfil') }}">
                @csrf
                @method('POST')

                <div class="form-group mt-2">
                    <label for="email"> E-mail </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com"
                        value="{{ Auth::user()->email }}">
                    <small id="email_information" class="form-text text-muted"> {{-- --}} </small>
                    @error('email')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="name"> Nome </label>
                    <input type="name" class="form-control" name="name" id="name" placeholder="Nome Completo"
                        value="{{ Auth::user()->name }}">
                    <small id="name_information" class="form-text text-muted"> {{-- --}} </small>
                    @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="user-update-cpf"> CPF </label>
                    <input type="text" class="form-control" id="user-update-cpf" onKeyUp="cpfMask()" name="document" 
                        value="{{ Auth::user()->document }}">
                    <small id="document_information" class="form-text text-muted"> {{-- --}} </small>
                    @error('document')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-success mt-4" type="submit"> Atualizar </button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form method="post" action="{{ route('update_password') }}">
                @csrf
                @method('POST')

                <div class="row">
                    <div class="col-6">
                        <div class="form-group mt-2">
                            <label for="password"> Senha </label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Senha">
                            <small id="password_information" class="form-text text-muted"> {{-- --}} </small>
                            @error('password')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-2">
                            <label for="password_confirmation"> Confirmar Senha </label>
                            <input type="password_confirmation" class="form-control" name="password_confirmation"
                                id="password_confirmation" placeholder="Senha">
                            <small id="password_confirmation_information" class="form-text text-muted"> {{-- --}}
                            </small>
                            @error('password_confirmation')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-success mt-4" type="submit"> Atualizar </button>
                </div>
        </div>
    </div>
</div>
@endsection