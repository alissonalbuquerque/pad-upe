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

            
                
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h3>
            <i class="bi bi-exclamation-octagon-fill"></i>
            Relatório pad {{$pad->nome}}
        </h3>
        @include('components.buttons.btn-download', [
            'route' => route('pad_relatório_pdf'),
            'content' => 'Baixar PADs enviados',
            'id' => '',
            'class' => '',
        ])
    </div>
    <div class="card d-flex">
        <div class="card-head d-flex justify-content-center" style="background-color:#dfdfdf; padding-top:10px;">
            <h6 class="card-title" style="font-weight:bold;">PROFESSORES QUE NÃO ENVIARAM O PAD</h6>
        </div>
        <div class="card-body">

                <table class="table table-hover table-striped table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope='col'></th>
                        <th scope='col'>Professor</th>
                        <th scope='col'>Curso</th>
                        <th scope='col'>Campus</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                        @php $index = 1; @endphp
                        @foreach($professores as $professor)
                            @if($professor->status == "Pendente")
                            <tr scope='row'>
                                <td>{{$index}}</td>
                                <td>{{$professor->name}}</td>
                                <td>{{$professor->curso}}</td>
                                <td>{{$professor->campus}}</td>
                            </tr>
                            @php $index += 1 @endphp
                            @endif
                        @endforeach
                    </tbody>

                </table>

        </div>
    </div>
                


    <div class="card d-flex" style='margin-top:20px;'>
        <div class="card-head d-flex justify-content-center" style="background-color:#dfdfdf; padding-top:10px;">
            <h6 class="card-title" style="font-weight:bold;">RELAÇÃO DOS PROFESSORES QUE ENVIARAM O PAD</h6>
        </div>
        <div class="card-body">

                <table class="table table-hover table-striped table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope='col'></th>
                        <th scope='col'>Professor</th>
                        <th scope='col'>CH Ensino</th>
                        <th scope='col'>CH Pesquisa</th>
                        <th scope='col'>CH Extensão</th>
                        <th scope='col'>CH Gestão</th>
                        <th scope='col'>Campus</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                        @php $index = 1; @endphp
                        @foreach($professores as $professor)
                            @if($professor->status != "Pendente")
                            <tr scope='row'>
                                <td>{{$index}}</td>
                                <td>{{$professor->name}}</td>
                                
                                <td>{{$professor->ch_ensino}}</td>
                                <td>{{$professor->ch_pesquisa}}</td>
                                <td>{{$professor->ch_extensao}}</td>
                                <td>{{$professor->ch_gestao}}</td>

                                <td>{{$professor->campus}}</td>
                            </tr>
                            @php $index += 1 @endphp
                            @endif
                        @endforeach
                    </tbody>
                    
                </table>

        </div>
    </div>



@endsection