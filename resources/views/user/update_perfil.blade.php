@extends('layouts.main')

@section('title', 'Atulizar Perfil')

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

@section('body')

    @include('components.alerts')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Atualizar Perfil </h1>
    </div>

    <div class="content">
        <!-- Tab Panel -->
        <div class="mb-4">
            <ul class="nav nav-tabs" id="tab-link" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="perfil-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="perfil" aria-selected="true"> Perfil </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="senha-tab" data-toggle="tab" href="#senha" role="tab" aria-controls="senha" aria-selected="false"> Senha </a>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content" id="tab-content">
            <!-- Perfil -->
            <div class="tab-pane fade show active" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
                <form class="" method="post" action="{{ route('update_perfil') }}" >
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="email"> E-mail </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" value="{{ Auth::user()->email }}">
                        <small id="email_information" class="form-text text-muted"> {{-- --}} </small>
                        @error('email')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name"> Nome </label>
                        <input type="name" class="form-control" name="name" id="name" placeholder="Nome Completo" value="{{ Auth::user()->name }}">
                        <small id="name_information" class="form-text text-muted"> {{-- --}} </small>
                        @error('name')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="document"> CPF </label>
                        <input type="document" class="form-control" name="document" id="document" placeholder="Senha" value="{{ Auth::user()->document }}">
                        <small id="document_information" class="form-text text-muted"> {{-- --}} </small>
                        @error('document')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success" type="submit"> Atualizar </button>
                    </div>
                </form>
            </div>
            
            <!-- Senha -->
            <div class="tab-pane fade" id="senha" role="tabpanel" aria-labelledby="senha-tab">
                <form method="post" action="{{ route('update_password') }}">
                    @csrf
                    @method('POST')

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

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success" type="submit"> Atualizar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
