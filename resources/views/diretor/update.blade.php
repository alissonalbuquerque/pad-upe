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
        <form class="" method="post" action="{{ route('diretor_update',  $user->id ) }}">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="email"> E-mail </label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com"
                    value="{{ $user->email }}">
                <small id="email_information" class="form-text text-muted"> {{--  --}} </small>
                @error('email')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name"> Nome </label>
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome Completo"
                    value="{{ $user->name }}">
                <small id="name_information" class="form-text text-muted"> {{--  --}} </small>
                @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="document"> CPF </label>
                <input type="document" class="form-control" name="document" id="document" placeholder="Senha"
                    value="{{ $user->document }}">
                <small id="document_information" class="form-text text-muted"> {{--  --}} </small>
                @error('document')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="selectUnidade">Unidade</label>
                <select class="custom-select mr-sm-2" name="unidade_id" id="selectUnidade"
                    aria-label="Default select example">
                    <option value="" disabled selected hidden> selecione... </option>
                    @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}" {{ $user->unidade_id == $unidade->id ? 'selected' : '' }}>{{ $unidade->name }}</option>
                    @endforeach
                </select>
                @error('unidade_id')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

    {{--         <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="password"> Senha </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Senha" value="">
                        <small id="password_information" class="form-text text-muted"> {{--  --}} </small>
                        @error('password')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
            </div> --}}

            <div class="d-flex justify-content-end">
                <button class="btn btn-success" type="submit"> Atualizar </button>
            </div>
        </form>
    </div>
@endsection
