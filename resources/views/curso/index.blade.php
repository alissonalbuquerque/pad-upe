@extends('layouts.main')

@section('title', 'Cursos')
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
    <div class="d-flex justify-content-between align-items-center border-bottom">
        <h2 class="">TODOS OS CURSO</h2>
        @include('components.buttons.btn-create', [
            'route' => route('curso_create'),
            'class' => '',
            'content' => 'Novo Curso',
            'id' => '',
        ])
    </div>
    <!-- Tabela -->
    <div class="table-responsive mt-5">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Campus</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($campusWithCursos as $campusWithCurso)
                    @foreach ($campusWithCurso->cursos as $curso)
                        <tr>
                            <td>{{ $curso->name }}</td>
                            <td>{{ $curso->campus }}</td>
                            <td>
                                @include('components.buttons.btn-edit', [
                                    'btn_class' => 'btn btn-warning',
                                    'route' => route('curso_edit', ['id' => $curso->id]),
                                ])
                                @include('components.buttons.btn-soft-delete', [
                                    'route' => route('curso_delete', ['id' => $curso->id]),
                                    'modal_id' => $curso->id,
                                ])
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <div class="accordion" id="accordionExample">
        @foreach ($campusWithCursos as $campusWithCurso)
            <div class="card" style="width: 50vw;">
                <div class="card-header" id="heading{{ $campusWithCurso->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link p-0" type="button" data-toggle="collapse"
                            data-target="#collapse{{ $campusWithCurso->id }}" aria-expanded="true"
                            aria-controls="collapse{{ $campusWithCurso->id }}">
                            {{ $campusWithCurso->name }}
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $campusWithCurso->id }}" class="collapse"
                    aria-labelledby="heading{{ $campusWithCurso->id }}"
                    data-parent="#accordion{{ $campusWithCurso->id }}">

                    <div class="card-body">
                        <div class="accordion-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Campus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($campusWithCurso->cursos as $curso)
                                        <tr>
                                            <th>{{ $curso->id }}</th>
                                            <td>{{ $curso->name }}</td>
                                            <td>{{ $curso->campus }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div> --}}

@endsection
