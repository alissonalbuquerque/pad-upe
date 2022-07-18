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

            <div class="row">

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="inputNameCurso">Nome do Curso</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Curso" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="campus_id">Campus</label>
                        <select class="form-select" name="campus_id" id="campus_id"
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
                </div>

                <div class="mt-1 text-end">
                    @include('components.buttons.btn-cancel', [
                        'route' => route('curso_index'),
                        'content' => 'Cancelar'
                    ])

                    @include('components.buttons.btn-save', [
                        'btn_class' => 'btn btn-outline-success',
                        'content' => 'Cadastrar',
                    ])
                </div>

            </div>

        </form>
    </div>
@endsection
