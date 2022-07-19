@extends('layouts.main')

@section('title', 'Cadastro - Professor')

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
        <h1 class="h2"> Cadastrar novo Professor</h1>
    </div>

    <div class="content">
        <form class="" method="post" action="{{ route('professor_store') }}">
            @csrf
            @method('POST')

            <div class="form-group mt-2">
                <label for="email"> E-mail </label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com"
                    value="">
                <small id="email_information" class="form-text text-muted"> {{--  --}} </small>
                @error('email')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="name"> Nome </label>
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome Completo"
                    value="">
                <small id="name_information" class="form-text text-muted"> {{--  --}} </small>
                @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="document"> CPF </label>
                <input type="document" class="form-control" name="document" id="document" placeholder="Senha"
                    value="">
                <small id="document_information" class="form-text text-muted"> {{--  --}} </small>
                @error('document')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

            <div class="form-group mt-2">
                <label for="selectCurso">Curso</label>
                <select class="form-select form-select" name="curso_id" id="selectCurso"
                    aria-label="Default select example">
                    <option value="" disabled selected hidden> selecione... </option>

                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->name }}</option>
                    @endforeach
                </select>
                @error('curso_id')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

            <div class="row mt-2">
                <div class="col-6">
                    <div class="form-group">
                        <label for="password"> Senha </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                        <small id="password_information" class="form-text text-muted"> {{--  --}} </small>
                        @error('password')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-success" type="submit"> Salvar </button>
            </div>
        </form>
    </div>
@endsection
