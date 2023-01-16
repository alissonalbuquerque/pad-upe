@extends('layouts.main')

@section('title', 'Novo')
@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection
@section('nav')
    @include('layouts.navigation', [])
@endsection
@section('body')

    <div class="mb-3">
        <h3 class="h4"> PAD - Novo </h3>
    </div>

    <!-- Tabs -->
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pad-tab" data-bs-toggle="tab" data-bs-target="#pad-container" type="button" role="tab" aria-controls="pad-container" arial-selected="true"> PAD </button>
            </li>
        </ul>
    </div>

    <!-- Panels -->
    <div id="tab-containers" class="tab-content">
        <div id="pad-container" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pad-tab">
            
            <div class="mt-2 px-2">
                <form class="form" action="{{route('pad_store')}}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="nome">Nome</label>
                            <input class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" id="nome" value="{{ old('nome') }}">
                            @error('nome')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="col">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                                @foreach($status as $value => $content)
                                    <option value="{{$value}}">{{$content}}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="data_inicio">Data de Início</label>
                            <input class="form-control @error('data_inicio') is-invalid @enderror" type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio') }}">
                            @error('data_inicio')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="data_fim">Data de Fim</label>
                            <input class="form-control @error('data_fim') is-invalid @enderror" type="date" name="data_fim" id="data_fim" value="{{ old('data_fim') }}">
                            @error('data_fim')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                            @enderror
                        </div>
                
                    </div>

                    <div class="mt-1 text-end">
                        @include('components.buttons.btn-cancel', [
                            'route' => route('pad_index'),
                            'content' => 'Cancelar'
                        ])

                        @include('components.buttons.btn-save', [
                            'btn_class' => 'btn btn-outline-success',
                            'content' => 'Cadastrar',
                        ])
                    </div>
                    
                </form>
            </div>
            
        </div>
    </div>

@endsection
