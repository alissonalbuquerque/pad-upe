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
                    <th scope="col">Dimensão</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Professor 1</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 2</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 3</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 4</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 5</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 6</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 7</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 8</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 9</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 10</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 11</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 12</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 13</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 14</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>

                <tr>
                    <td>Professor 17</td>
                    <td>Ensino</td>
                    <td>

                        @include('components.buttons.btn-avaliar', [
                            'route' => route('avaliador_avaliar'),
                            'class' => '',
                            'content' => 'Avaliar',
                            'id' => '',
                        ])
                    </td>
                </tr>
               {{--  @foreach ($campus as $camp)
                    <tr>
                        <td>{{ $camp->name }}</td>
                        <td>{{ $camp->unidade }}</td>
                        <td>
                            @include('components.buttons.btn-edit', [
                                'btn_class' => 'btn btn-warning',
                                'route' => route('campus_edit', ['id' => $camp->id]),
                            ])
                            @include('components.buttons.btn-soft-delete', [
                                'modal_id' => $camp->id, 'route' => route('campus_delete', ['id' => $camp->id])
                            ])
                        </td>
                    </tr>
                @endforeach  --}}
            </tbody>
        </table>
    </div>
@endsection
