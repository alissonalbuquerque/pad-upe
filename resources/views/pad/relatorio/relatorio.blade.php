@extends('layouts.main')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', ['menu' => $index_menu])
@endsection
@section('title', 'Relatórios')
@section('body')
        <div class="tab-content">
            
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Relatórios</h1>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h3>
                        <i class="bi bi-exclamation-octagon-fill"></i>
                        Relatório pad {{$pad->nome}}
                    </h3>
                </div>

                <table class="table">
                    <thead>
                        <th scope='col'>Professor</th>
                        <th scope='col'>Ch Ensino</th>
                        <th scope='col'>Ch Pesqiosa</th>
                        <th scope='col'>Ch Extensão</th>
                        <th scope='col'>Ch Gestão</th>
                        <th scope='col'>Curso</th>
                    </thead>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    <tbody>

                    </tbody>
                </table>
            </div>


        </div>


@endsection