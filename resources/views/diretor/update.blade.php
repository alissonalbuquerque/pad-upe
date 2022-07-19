@extends('layouts.main')

@section('title', 'Atualizar Perfil')

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
    {{ dd('implementar') }}
    {{ dd($user) }}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Atualizar Perfil</h1>
    </div>

    <div class="content">
        <form class="" method="post" action="{{ route('diretor_update', $user->id) }}">
            @csrf
            @method('POST')

            <div class="form-group mt-2">
                <label for="email"> E-mail </label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com"
                    value="{{ $user->email }}">
                <small id="email_information" class="form-text text-muted"> {{--  --}} </small>
                @error('email')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="name"> Nome </label>
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome Completo"
                    value="{{ $user->name }}">
                <small id="name_information" class="form-text text-muted"> {{--  --}} </small>
                @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="document"> CPF </label>
                <input type="document" class="form-control" name="document" id="document" placeholder="Senha"
                    value="{{ $user->document }}">
                <small id="document_information" class="form-text text-muted"> {{--  --}} </small>
                @error('document')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="selectCampus">Campus</label>
                <select class="form-select form-select" name="campus_id" id="selectCampus"
                    aria-label="Default select example">
                    <option value="" disabled selected hidden> selecione... </option>

                    @foreach ($campus as $camp)
                        <option value="{{ $camp->id }}" {{ $user->campus_id == $camp->id ? 'selected' : '' }}>
                            {{ $camp->name }}</option>
                    @endforeach
                </select>
                @error('campus_id')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" value="" id="alter-password">
                <label class="form-check-label" for="flexCheckDefault">
                    Alterar senha
                </label>
            </div>
            
            <div class="col-6">
                <div class="form-group">
                    <label for="password"> Nova Senha </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Senha"
                        value="" disabled>
                    <small id="password_information" class="form-text text-muted"> {{--  --}} </small>
                    @error('password')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-success" type="submit"> Atualizar </button>
                </div>
            </div>
        </form>
    </div>
@endsection
