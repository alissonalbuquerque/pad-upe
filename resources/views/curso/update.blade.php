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
    <div class="content mx-auto">
        <h1 class="titulo pt-4 pb-4 mb-3 border-bottom">CADASTRO CURSO</h1>
        <p class="pb-4 mb-3 text-center text-muted align-items-center">
            Insira os dados correspondentes nos campos exibidos abaixo
        </p>
        <!-- Formulario -->
        <form action="{{ route('curso_update', $curso->id ) }}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="inputNameCurso">Nome do Curso</label>
                <input type="text" class="form-control" name="name" id="inputNameCurso"
                    placeholder="Insira o nome do Curso" value="{{ $curso->name }}">
            </div>
            <div class="form-group">
                <label for="selectCampus">Campus</label>
                <select class="custom-select mr-sm-2" name="campus_id" id="inlineFormCustomSelect"
                    aria-label="Default select example">
                    <option selected>Selecionar o Campus</option>
                    @foreach ($allCampus as $campus)
                        <option value="{{ $campus->id }}" {{ $curso->campus->id == $campus->id ? 'selected' : '' }}>{{ $campus->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-between">
                @include('components.buttons.btn-cancel', [
                    'route' => route('curso_index'),
                ])
                @include('components.buttons.btn-save')
            </div>
        </form>
    </div>
@endsection
