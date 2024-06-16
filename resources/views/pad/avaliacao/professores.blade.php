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
    @include('components.alerts')
    <div class="d-flex justify-content-between align-items-center border-bottom">
        <h2 class="">PADs</h2>
    </div>

    <!-- Tabela -->
    <div class="table-responsive mt-5">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Professor</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Status</th>
                    <th scope="col">CH</th>
                    <th scope="col">CH Corrigida</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($professores as $professor)
                    <tr>
                        <td>{{$professor->name}}</td>
                        <td>{{$professor->email}}</td>
                        @if($professor->status === 'Pendente')
                            <td style="color:red;">{{$professor->status}}</td>
                        @else
                            <td style="color:green;">{{$professor->status}}</td>
                        @endif
                        <td>@if($professor->ch > 0) {{$professor->ch}}H @endif</td>
                        <td>@if($professor->ch_corrigida > 0 && $professor->ch != $professor->ch_corrigida) {{$professor->ch_corrigida}}H @endif</td>
                        <td>
                            
                            <div class="btn-group" role="group" aria-label="">

                                @include('components.buttons.btn-avaliar', [
                                    'route' => url("/pad/$pad->id/professor/$professor->id/atividades"), #avaliador_avaliar
                                    'class' => '',
                                    'content' => 'Avaliar',
                                    'id' => '',
                                ])
                                
                                <div class="btn-edit-tasks">
                                    <button type="button" class="btn btn-primary btn-view_modal" id="{{ "pad_{$pad->id}-professor_{$professor->id}" }}">
                                        <i class="bi bi-clock"></i> Horário
                                    </button>
                                </div>

                            </div>
                            
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

    @include('components.modal', ['size' => 'modal-xl'])

@endsection

@section('scripts')

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('mostrar_horario'),
        'btn_class' => 'btn-view_modal',
    ])

@endsection
