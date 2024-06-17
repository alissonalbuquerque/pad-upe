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

    @php
        $tab = isset($tab) ? $tab : 'pad';

        $tab_options_tab = [
            'pad'           => $tab == 'pad'           ? 'active' : '',
            'user_pad'      => $tab == 'user_pad'      ? 'active' : '',
            'avaliator_pad' => $tab == 'avaliator_pad' ? 'active' : '',
        ];

        $tab_options_panel = [
            'pad'           => $tab == 'pad'           ? 'show active' : '',
            'user_pad'      => $tab == 'user_pad'      ? 'show active' : '',
            'avaliador_pad' => $tab == 'avaliator_pad' ? 'show active' : '',
        ];

        dd($tab_options_tab['avaliador_pad']);
    @endphp
    <!-- Tabs -->
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab_options_tab['pad'] }}">PDA</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab_options_tab['user_pad'] }}">Professores</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab_options_tab['avaliator_pad'] }}">Avaliadores</a>
            </li>
        </ul>
    </div>

    <!-- Panels -->
    <div class="tab-content">
        <div class="tab-pane fade {{ $tab_options_panel['pad'] }}" id="pad-container">
            <div class="mt-2 px-2">
                <form class="form" action="{{ route('pad_update', ['id' => $pad->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <!-- Form fields -->
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

        <div class="tab-pane fade {{ $tab_options_panel['user_pad'] }}" id="user_pad-container">
            <div class="border rounded px-2">
                <div class="text-end my-2">
                    <button type="button" class="btn btn-success user-pad-create">Cadastrar Professor</button>
                </div>

                <!-- Table -->
                <table id="user_pad-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Professor</th>
                            <th scope="col">PDA</th>
                            <th scope="col">C.H</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userPads as $userPad)
                        <tr>
                            <td>{{ $userPad->user }}</td>
                            <td>{{ $userPad->pad->nome }}</td>
                            <td><span class="badge bg-primary">{{ $userPad->totalHoras() }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <ul class="pagination justify-content-end">
                    {{ $userPads->appends(['tab' => 'user_pad'])->links() }}
                </ul>
            </div>
        </div>

        <div class="tab-pane fade {{ $tab_options_panel['avaliator_pad'] }}" id="avaliator_pad-container">
            <div class="border rounded px-2">
                <div class="text-end my-2">
                    <button type="button" class="btn btn-success avaliator-pad-create">Cadastrar Avaliador</button>
                </div>

                <!-- Table -->
                <table id="avaliator_pad-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Avaliador</th>
                            <th scope="col">PDA</th>
                            <th scope="col">Dimensão</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($avaliatorsPads as $avaliatorPad)
                        <tr>
                            <td>{{ $avaliatorPad->user->name ?? 'UserID não selecionado!' }}</td>
                            <td>{{ $avaliatorPad->pad->nome }}</td>
                            <td>{{ $avaliatorPad->dimensao }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <ul class="pagination justify-content-end">
                    {{ $avaliatorsPads->appends(['tab' => 'avaliator_pad'])->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection
