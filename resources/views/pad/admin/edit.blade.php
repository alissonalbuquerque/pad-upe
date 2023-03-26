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

    @include('components.alerts')

    <div class="mb-3">
        <h3 class="h4"> PAD - Atualizar </h3>
    </div>

    <!-- Tabs -->
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pad-tab" data-bs-toggle="tab" data-bs-target="#pad-container" type="button" role="tab" aria-controls="pad-container" arial-selected="true"> PAD </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="user_pad-tab" data-bs-toggle="tab" data-bs-target="#user_pad-container" type="button" role="tab" aria-controls="user_pad-container" arial-selected="false"> Professores </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="avaliator_pad-tab" data-bs-toggle="tab" data-bs-target="#avaliator_pad-container" type="button" role="tab" aria-controls="avaliator_pad-container" arial-selected="false"> Avaliadores </button>
            </li>
        </ul>
    </div>

    <!-- Panels -->
    <div id="tab-containers" class="tab-content">

        <div id="pad-container" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pad-tab">
            <div class="mt-2 px-2">

                <form class="form" action="{{route('pad_update', ['id' => $pad->id])}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="nome">Nome</label>
                            <input class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" id="nome" value="{{ $pad->nome }}">
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
                            <input class="form-control @error('data_inicio') is-invalid @enderror" type="date" name="data_inicio" id="data_inicio" value="{{ $pad->data_inicio }}">
                            @error('data_inicio')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="data_fim">Data de Fim</label>
                            <input class="form-control @error('data_fim') is-invalid @enderror" type="date" name="data_fim" id="data_fim" value="{{ $pad->data_fim }}">
                            @error('data_fim')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-4 text-end">
                        @include('components.buttons.btn-save', [
                            'btn_class' => 'btn btn-outline-success',
                            'content' => 'Atualizar',
                        ])

                        @include('components.buttons.btn-cancel', [
                            'route' => route('pad_index'),
                            'content' => 'Cancelar'
                        ])
                    </div>
                </form>

            </div>
        </div>


        <div id="user_pad-container" class="tab-pane fade" role="tabpanel" aria-labelledby="user_pad-tab">

            <div class="border rounded px-2">

                <div class="text-end my-2">
                    <button type="button" class="btn btn-success user-pad-create"> Cadastrar Professor </button>
                </div>

                <table id="user_pad-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col"> Professor </th>
                            <th scope="col"> PAD </th>
                            <th scope="col"> C.H </th>
                            <th scope="col"> Opções </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($userPads as $userPad)
                        <tr>
                            <td>{{ $userPad->user }}</td>
                            <td>{{ $userPad->pad->nome }}</td>
                            <td> <span class="badge bg-primary">{{ $userPad->totalHoras() }}</span> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        <div id="avaliator_pad-container" class="tab-pane fade" role="tabpanel" aria-labelledby="user_pad-tab">

            <div class="border rounded px-2">

                <div class="text-end my-2">
                    <button type="button" class="btn btn-success valiator-pad-create"> Cadastrar Avaliador </button>
                </div>

                <table id="avaliator_pad-table" class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col"> Professor </th>
                        <th scope="col"> PAD </th>
                        <th scope="col"> Dimensão </th>
                        <th scope="col"> Opções </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($avaliatorsPads as $avaliatorPad)
                    <tr>
                        <td>{{ $avaliatorPad->user->name }}</td>
                        <td>{{ $avaliatorPad->pad->nome }}</td>
                        <td>
{{--                          @foreach($avaliatorPad->dimensions as $dimension)
                                <span class="badge bg-primary">{{ $dimension->nome }}</span>
                            @endforeach --}}
                        </td>
                        <td>{{ $avaliatorPad->dimensao }}</td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>

        </div>


    </div>




    @include('components.modal', ['size' => 'modal-lg'])

@endsection

@section('scripts')

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('user-pad_create', ['pad_id' => $pad->id]),
        'btn_class' => 'user-pad-create',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('user-pad_create', ['pad_id' => $pad->id]),
        'btn_class' => 'valiator-pad-create',
    ])
@endsection
