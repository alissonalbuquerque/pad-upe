@extends('layouts.main')

@section('title', 'Início')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', [])
@endsection

@section('body')

    <div class="">
        
        <h3> PAD - Listagem </h3>

        <div class="">

            @include('components.alerts')

            <div class="d-flex justify-content-end mb-2">
                @include('components.buttons.btn-create', [
                    'id' => 'pad_create',
                    'class' => 'btn-outline-success',
                    'route' => route('pad_create'),
                    'content' => 'Cadastrar',
                ])
            </div>
            
            <div class="border rounded px-4">

                <table class="table table-hover mt-4">
                    <thead>
                        <tr>
                            <th scole="col">#</th>
                            <th scole="col">Nome</th>
                            <th scole="col">Data de início</th>
                            <th scole="col">Data de fim</th>
                            <th scole="col">Status</th>
                            <th scole="col">Opções</th>
                        </tr>
                    </thead>
                    
                    @php 
                        $index_row = 1;
                    @endphp
                    <tbody>
                        @foreach($pads as $pad)
                        <tr>
                            <td scope="row">{{ $index_row++ }}</td>
                            <td>{{ $pad->nome }}</td>
                            <td>{{ $pad->getDateInicio() }}</td>
                            <td>{{ $pad->getDateFim() }}</td>
                            <td>{{ $pad->getStatusAsText() }}</td>
                            <td>
                                @include('components.buttons.btn-edit', [
                                    'btn_class' => 'btn btn-outline-primary',
                                    'route' => route('pad_edit', ['id' => $pad->id])
                                ])

                                @include('components.buttons.btn-delete', [
                                    'id' => $pad->id,
                                    'btn_class' => 'btn btn-outline-danger',
                                    'route' => route('pad_delete', ['id' => $pad->id])
                                ])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>
@endsection

@section('script')

<script type="text/javascript">
    
</script>

@endsection