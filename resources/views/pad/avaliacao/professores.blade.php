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
                    <th scope="col">Status</th>
                    
                    <th scope="col">Opções</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($professores as $professor)
                    <tr>
                        <td>{{$professor->name}}</td>
                        @if($professor->status === 'Pendente')
                            <td style="color:red;">{{$professor->status}}</td>
                        @else
                            <td style="color:green;">{{$professor->status}}</td>
                        @endif
                        <td>

                            @include('components.buttons.btn-avaliar', [
                                'route' => url("/pad/$pad->id/professor/$professor->id/atividades"), #avaliador_avaliar
                                'class' => '',
                                'content' => 'Avaliar',
                                'id' => '',
                            ])
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
