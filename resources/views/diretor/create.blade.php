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
        <h1 class="h2"> Cadastrar novo diretor</h1>
    </div>

    <div class="content">
        <form class="" method="post" action="{{ route('diretor_store') }}">
            @csrf
            @method('POST')

            <div class="row">

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="email"> E-mail </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" value="{{ old('email') }}">
                        <small id="email_information" class="form-text text-muted"> {{--  --}} </small>
                        @error('email')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="name"> Nome </label>
                        <input type="name" class="form-control" name="name" id="name" placeholder="Nome Completo" value="{{ old('name') }}">
                        <small id="name_information" class="form-text text-muted"> {{--  --}} </small>
                        @error('name')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="document"> Documento (CPF) </label>
                        <input type="document" class="form-control" name="document" id="document" value="{{ old('document') }}" placeholder="Documento (CPF)" >
                        <small id="document_information" class="form-text text-muted"> {{--  --}} </small>
                        @error('document')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="unidade_id">Unidade</label>
                        <select class="form-select" name="unidade_id" id="unidade_id"
                            aria-label="Default select example">
                            <option value="" disabled selected hidden> selecione... </option>
                            @foreach ($unidades as $unidade)
                                @if( old('unidade_id') == $unidade->id)
                                    <option selected value="{{ $unidade->id }}">{{ $unidade->name }}</option>
                                @else
                                    <option value="{{ $unidade->id }}">{{ $unidade->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('unidade_id')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                
                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="password"> Senha </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                        <small id="password_information" class="form-text text-muted"> {{--  --}} </small>
                        @error('password')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    
                </div>

                <div class="mb-3 col-sm-6">
                    <!-- Confirmação de Senha -->
                </div>

                <div class="mt-1 text-end">
                    @include('components.buttons.btn-cancel', [
                        'route' => route('diretor_index'),
                        'content' => 'Cancelar'
                    ])

                    @include('components.buttons.btn-save', [
                        'content' => 'Cadastrar'
                    ])
                </div>
            </div>

        </form>
    </div>
@endsection
