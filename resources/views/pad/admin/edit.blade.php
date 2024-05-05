@php
    /**
     * @var $pad App\Models\Pad
     * @var $menu integer
     * @var $status integer
     * @var $user_pads Illuminate\Database\Eloquent\Collection<App\Models\UserPad>
     * @var $avaliador_pads Illuminate\Database\Eloquent\Collection<App\Models\AvaliadorPad>
     * @var $user_pad_search App\Search\UserPadSearch
     * @var $avaliador_pad_search App\Search\AvaliadorPadSearch
     */
@endphp

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
        <h3 class="h4"> PDA - Atualizar </h3>
    </div>

    <!-- Tabs -->
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pad-tab" data-bs-toggle="tab" data-bs-target="#pad-container" type="button" role="tab" aria-controls="pad-container" arial-selected="true"> PDA </button>
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

                @include('pad/admin/search/_user_pad_search', ['model' => $user_pad_search])

                {{-- Create Professor --}}
                <div class="text-end my-2">
                    <button type="button" class="btn btn-success user-pad-create"> Cadastrar Professor </button>
                </div>
                {{-- Create Professor --}}

                {{-- Table --}}
                <table id="user_pad-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col"> Professor </th>
                            <th scope="col"> PDA </th>
                            <th scope="col"> E-mail </th>
                            <th scope="col"> C.H </th>
                            <th scope="col"> Opções </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($user_pads as $user_pad)
                        <tr>
                            <td>{{ $user_pad->user }}</td>
                            <td>{{ $user_pad->pad->nome }}</td>
                            <td>{{ $user_pad->user->email }}</td>
                            <td> <span class="badge bg-primary">{{ $user_pad->total_horas() }}</span> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Table --}}

                {{-- Pagination --}}
                @if($user_pads->hasPages())
                    <ul class="pagination justify-content-end">

                        @if(!$user_pads->onFirstPage())
                            <li class="page-item"> <a class="page-link" href="{{ $user_pads->previousPageUrl() }}" tabindex="-1" aria-disabled="true">< Anterior</a> </li>
                        @endif

                        @if($user_pads->hasMorePages())
                            <li class="page-item"> <a class="page-link" href="{{ $user_pads->nextPageUrl() }}">Próximo > </a> </li>
                        @endif

                    </ul>
                @endif

            </div>

        </div>

        <div id="avaliator_pad-container" class="tab-pane fade" role="tabpanel" aria-labelledby="user_pad-tab">

            <div class="border rounded px-2">

                @include('pad/admin/search/_avaliador_pad_search', ['model' => $avaliador_pad_search])

                <div class="text-end my-2">
                    <button type="button" class="btn btn-success avaliator-pad-create"> Cadastrar Avaliador </button>
                </div>

                <table id="avaliator_pad-table" class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col"> Avaliador </th>
                        <th scope="col"> E-mail </th>
                        <th scope="col"> PDA </th>
                        <th scope="col"> Dimensão </th>
                        <th scope="col"> Opções </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($avaliador_pads as $avaliador_pad)
                    <tr>
                        <td>{{ $avaliador_pad->user->name ?? 'UserID não selecionado!' }}</td>
                        <td>{{ $avaliador_pad->user->email }}</td>
                        <td>{{ $avaliador_pad->pad->nome }}</td>
                        <td>
                            @foreach($avaliador_pad->dimensions as $dimension)
                                <span class="badge bg-primary">{{ $dimension }}</span>
                            @endforeach
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <div class="me-1">
                                    @include('components.buttons.btn-edit-task', [
                                        'btn_class' => 'btn-edit_avaliador_pad',
                                        'btn_id' => $avaliador_pad->id,
                                    ])
                                </div>
                                <div class="me-1">
                                    @include('components.buttons.btn-delete', [
                                        'id' => $avaliador_pad->id,
                                        'route' => route('avaliador-pad_delete', ['id' => $avaliador_pad->id])
                                    ])
                                </div>
                            </div>
                        </td>
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
        'route' => route('avaliator-pad_create', ['pad_id' => $pad->id]),
        'btn_class' => 'avaliator-pad-create',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('avaliador-pad_edit'),
        'btn_class' => 'btn-edit_avaliador_pad',
    ])
@endsection
