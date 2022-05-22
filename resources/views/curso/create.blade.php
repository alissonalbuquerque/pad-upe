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
        <form action="{{ route('curso_store') }}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="inputNameCurso">Nome do Curso</label>
                <input type="text" class="form-control" name="name" id="inputNameCurso"
                    placeholder="Insira o nome do Curso" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="selectCampus">Campus</label>
                <select class="custom-select mr-sm-2" name="campus_id" id="inlineFormCustomSelect"
                    aria-label="Default select example">
                    <option value="" disabled selected hidden> selecione... </option>
                    @foreach ($allCampus as $campus)
                        <option value="{{ $campus->id }}" {{ old('campus_id') == $campus->id ? 'selected' : '' }}>{{ $campus->name }}</option>
                    @endforeach
                </select>
                @error('campus_id')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
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
