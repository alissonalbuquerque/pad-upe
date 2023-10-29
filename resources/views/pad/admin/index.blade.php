@extends('layouts.main')

@section('title', 'Início')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', ['menu' => $menu])
@endsection

@section('body')

    <div>
        
        <h3 class="h3"> PDAs </h3>

        <div>

            @include('components.alerts')

            <div class="d-flex justify-content-end mb-2">
                @include('components.buttons.btn-create', [
                    'id' => 'pad_create',
                    'class' => 'btn-success',
                    'route' => route('pad_create'),
                    'content' => 'Cadastrar',
                ])
            </div>
            
            <div class="border rounded px-4">

                <table class="table table-responsive table-hover mt-4">
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
                            <td>{{ $pad->statusAsString() }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <div class="me-1">
                                        @include('components.buttons.btn-edit', [
                                            'btn_class' => 'btn btn-primary',
                                            'route' => route('pad_edit', ['id' => $pad->id])
                                        ])
                                    </div>
                                    <div class="me-1">
                                        @include('components.buttons.btn-delete', [
                                            'id' => $pad->id,
                                            'btn_class' => 'btn btn-danger',
                                            'route' => route('pad_delete', ['id' => $pad->id])
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
@endsection

@section('script')

<script type="text/javascript">
    
</script>

@endsection