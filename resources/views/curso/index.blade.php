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

    <div class="accordion" id="accordionExample">
        @foreach ($campusWithCursos as $campusWithCurso)
            <div class="card"  style="width: 50vw;">
                <div class="card-header" id="heading{{ $campusWithCurso->id }}"> 
                    <h5 class="mb-0">
                        <button class="btn btn-link p-0" type="button" data-toggle="collapse" data-target="#collapse{{ $campusWithCurso->id }}"
                            aria-expanded="true" aria-controls="collapse{{ $campusWithCurso->id }}">
                            {{ $campusWithCurso->name }}
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $campusWithCurso->id }}" class="collapse" 
                    aria-labelledby="heading{{ $campusWithCurso->id }}" data-parent="#accordion{{ $campusWithCurso->id }}">

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
    </div>
@endsection
