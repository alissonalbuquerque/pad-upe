@extends('layouts.main')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', ['menu' => $index_menu])
@endsection
@section('title', 'Horários')
@section('body')
        <div class="tab-content">
            
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Horários</h1>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h3> <i class="bi bi-clock-fill"></i> Horários Disponíveis </h3>
                </div>
                <div class="d-flex">
                    {{-- @foreach($userPads as $userPad)
                        @include('avaliador-task-time.card_horario', ['userPad' => $userPad])
                    @endforeach --}}
                </div>
            </div>


        </div>


@endsection