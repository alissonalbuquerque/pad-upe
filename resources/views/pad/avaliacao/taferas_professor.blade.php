@extends('layouts.main')

@section('title', 'Ensino')
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
    <div class="container">
        @if(session('mensage'))    
        <div class="alert alert-success">
            {{session('mensage')}}
        </div>
        @endif

        <h3>{{$professor->name}}</h3><br><br>
        <div class="row justify-content-end">
            <div class="col-1">
                <a href='{{route("pad_professores", ["id" => $pad->id])}}' class='btn btn-outline-primary' >Voltar</a>
            </div>
        </div>

        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#ensino" type="button" role="tab" aria-controls="home" aria-selected="true">Ensino</button>
            </li>
            
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#pesquisa" type="button" role="tab" aria-controls="profile" aria-selected="false">Pesquisa</button>
            </li>
            
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#extensao" type="button" role="tab" aria-controls="contact" aria-selected="false">Extensão</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#gestao" type="button" role="tab" aria-controls="contact" aria-selected="false">Gestão</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Ensino -->
            <div class="tab-pane fade show active" id="ensino" role="tabpanel" aria-labelledby="ensino-tab">       
                @if (isset($avaliacoes_ensino) && !empty($avaliacoes_ensino))
                    @foreach ($avaliacoes_ensino as $avaliacao)
                        <div class="card">
                            <h5 class="card-header">Cód. Atividade - {{$avaliacao->tarefa->cod_atividade}}</h5>

                            <div class="card-body">
                                
                                <ul>
                                    @foreach($avaliacao->tarefa->avaliable_attributes as $key => $attribute)
                                        <li> <span class="fw-bold ">{{ $key }} </span><span class="card-text">{{ $avaliacao->tarefa->$attribute }}</span><br> </li>
                                    @endforeach
                                </ul>
                                
                                <span class="fw-bold">Status: </span> {{$avaliacao->getStatusAsText()}}
                                
                                @if($avaliacao->status == 3)
                                <div style="width: 100%;" class="btns-avaliar d-flex justify-content-end">
                                    <button
                                        type="button"
                                        class="btn btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal_avaliacao"
                                        style="height: 38px;"
                                        onclick=" setaDadosModalAvaliacao('{{$avaliacao->tarefa->id}}', '{{$avaliacao->tarefa->userPad->user->id}}', '6', '{{$avaliacao->type}}', '{{$avaliacao->id}}') ">
                                        Reprovar
                                    </button>

                                    <span>&nbsp;&nbsp;</span>

                                    <form action="{{route('avaliador_avaliar')}}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <input type="hidden" name="avaliacao_id" id="avaliacao_id" value="{{$avaliacao->id}}">
                                        <input type="hidden" name="tarefa_id" id="tarefa_id_aprovar" value="{{$avaliacao->tarefa->id}}">
                                        <input type="hidden" name="professor_id" id="professor_id_aprovar" value="{{$avaliacao->tarefa->userPad->user->id}}">
                                        <input type="hidden" name="status" id="status_aprovar" value='7'>
                                        <input type="hidden" name="atividade_type" id="atividade_type_aprovar" value="{{$avaliacao->type}}">
                                        <input type="submit" class="btn btn-primary" value="Aprovar">
                                    </form>
                                </div>
                                @endif

                            </div>
                        </div><br>
                    @endforeach

                    <div class="row justify-content-center">
                        <ul class="col-4 pagination pagination-sm ">
                            {{ $avaliacoes_ensino->links() }}
                        </ul>                    
                    </div>

                @endif
            </div>

            <!-- Pesquisa -->
            <div class="tab-pane fade" id="pesquisa" role="tabpanel" aria-labelledby="pesquisa-tab">          
                @if (isset($avaliacoes_pesquisa) && !empty($avaliacoes_pesquisa))

                    @foreach ($avaliacoes_pesquisa as $avaliacao)
                        <div class="card">
                            <h5 class="card-header">Cód. Atividade - {{$avaliacao->tarefa->cod_atividade}}</h5>

                            <div class="card-body">
                                
                                <ul>
                                    @foreach($avaliacao->tarefa->avaliable_attributes as $key => $attribute)
                                        <li> <span class="fw-bold ">{{ $key }} </span><span class="card-text">{{ $avaliacao->tarefa->$attribute }}</span><br> </li>
                                    @endforeach
                                </ul>

                                <p> <span class="fw-bold ">Status: </span> {{$avaliacao->getStatusAsText()}} </p>
                                
                                @if($avaliacao->status == 3)
                                <div style="width: 100%; " class="btns-avaliar d-flex justify-content-end">
                                    <button
                                        type="button"
                                        class="btn btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal_avaliacao"
                                        style="height: 38px;"
                                        onclick=" setaDadosModalAvaliacao('{{$avaliacao->tarefa->id}}', '{{$avaliacao->tarefa->userPad->user->id}}', '6', '{{$avaliacao->type}}', '{{$avaliacao->id}}') ">
                                        Reprovar
                                    </button>

                                    <span>&nbsp;&nbsp;</span>

                                    <form action="{{route('avaliador_avaliar')}}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <input type="hidden" name="avaliacao_id" id="avaliacao_id" value="{{$avaliacao->id}}">
                                        <input type="hidden" name="tarefa_id" id="tarefa_id_aprovar" value="{{$avaliacao->tarefa->id}}">
                                        <input type="hidden" name="professor_id" id="professor_id_aprovar" value="{{$avaliacao->tarefa->userPad->user->id}}">
                                        <input type="hidden" name="status" id="status_aprovar" value='7'>
                                        <input type="hidden" name="atividade_type" id="atividade_type_aprovar" value="{{$avaliacao->type}}">
                                        <input type="submit" class="btn btn-primary" value="Aprovar">
                                    </form>

                                </div>
                                @endif

                            </div>
                        </div><br>
                    @endforeach
                    <div class="row justify-content-center">
                        <ul class="col-4 pagination pagination-sm ">
                            {{ $avaliacoes_pesquisa->links() }}
                        </ul>                    
                    </div>
                @endif

            </div>
            
            <!-- Extensão -->
            <div class="tab-pane fade" id="extensao" role="tabpanel" aria-labelledby="extensao-tab">
                @if (isset($avaliacoes_extensao) && !empty($avaliacoes_extensao))

                    @foreach ($avaliacoes_extensao as $avaliacao)
                        <div class="card">
                            <h5 class="card-header">Cód. Atividade - {{$avaliacao->tarefa->cod_atividade}}</h5>

                            <div class="card-body">
                                
                                <ul>
                                    @foreach($avaliacao->tarefa->avaliable_attributes as $key => $attribute)
                                        <li> <span class="fw-bold ">{{ $key }} </span><span class="card-text">{{ $avaliacao->tarefa->$attribute }}</span><br> </li>
                                    @endforeach
                                </ul>
                                
                                <p> <span class="fw-bold ">Status: </span> {{$avaliacao->getStatusAsText()}} </p>
                                    
                                @if($avaliacao->status == 3)
                                <div style="width: 100%; " class="btns-avaliar mt-5 d-flex justify-content-end">
                                    <button
                                        type="button" class="btn btn-outline-danger" 
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal_avaliacao" 
                                        style="height: 38px;"
                                        onclick=" setaDadosModalAvaliacao('{{$avaliacao->tarefa->id}}', '{{$avaliacao->tarefa->userPad->user->id}}', '6', '{{$avaliacao->type}}', '{{$avaliacao->id}}') ">
                                        Reprovar
                                    </button>

                                    <span>&nbsp;&nbsp;</span>

                                    <form action="{{route('avaliador_avaliar')}}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <input type="hidden" name="avaliacao_id" id="avaliacao_id" value="{{$avaliacao->id}}">
                                        <input type="hidden" name="tarefa_id" id="tarefa_id_aprovar" value="{{$avaliacao->tarefa->id}}">
                                        <input type="hidden" name="professor_id" id="professor_id_aprovar" value="{{$avaliacao->tarefa->userPad->user->id}}">
                                        <input type="hidden" name="status" id="status_aprovar" value='7'>
                                        <input type="hidden" name="atividade_type" id="atividade_type_aprovar" value="{{$avaliacao->type}}">
                                        <input type="submit" class="btn btn-primary" value="Aprovar">
                                    </form>

                                </div>
                                @endif

                            </div>
                        </div><br>
                    @endforeach
                    <div class="row justify-content-center">
                        <ul class="col-4 pagination pagination-sm ">
                            {{ $avaliacoes_extensao->links() }}
                        </ul>                    
                    </div>

                @endif

            </div>


            <div class="tab-pane fade" id="gestao" role="tabpanel" aria-labelledby="gestao-tab">

                @if (isset($avaliacoes_gestao) && !empty($avaliacoes_gestao))

                    @foreach ($avaliacoes_gestao as $avaliacao)
                        <div class="mb-4">
                            <div class="card">
                                <h5 class="card-header"> Cód. Atividade - {{$avaliacao->tarefa->cod_atividade}} </h5>

                                <div class="card-body">

                                    <ul>
                                        @foreach($avaliacao->tarefa->avaliable_attributes as $key => $attribute)
                                            <li> <span class="fw-bold ">{{ $key }} </span><span class="card-text">{{ $avaliacao->tarefa->$attribute }}</span><br> </li>
                                        @endforeach
                                    </ul>

                                    <p> <span class="fw-bold ">Status: </span> {{$avaliacao->getStatusAsText()}} </p>
                                    
                                    @if($avaliacao->status == 3)
                                    <div class="btns-avaliar mt-4 d-flex justify-content-end">
                                        <button 
                                            type="button"
                                            class="btn btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal_avaliacao"
                                            style="height: 38px;"
                                            onclick=" setaDadosModalAvaliacao('{{$avaliacao->tarefa->id}}', '{{$avaliacao->tarefa->userPad->user->id}}', '6', '{{$avaliacao->type}}', '{{$avaliacao->id}}') ">
                                            Reprovar
                                        </button>

                                        <span>&nbsp;&nbsp;</span>

                                        <form action="{{route('avaliador_avaliar')}}" method="POST">
                                            @csrf
                                            @method("PUT")
                                            <input type="hidden" name="avaliacao_id" id="avaliacao_id" value="{{$avaliacao->id}}">
                                            <input type="hidden" name="tarefa_id" id="tarefa_id_aprovar" value="{{$avaliacao->tarefa->id}}">
                                            <input type="hidden" name="professor_id" id="professor_id_aprovar" value="{{$avaliacao->tarefa->userPad->user->id}}">
                                            <input type="hidden" name="status" id="status_aprovar" value='7'>
                                            <input type="hidden" name="atividade_type" id="atividade_type_aprovar" value="{{$avaliacao->type}}">
                                            <input type="submit" class="btn btn-primary" value="Aprovar">
                                        </form>

                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row justify-content-center">
                        <ul class="col-4 pagination pagination-sm ">
                            {{ $avaliacoes_gestao->links() }}
                        </ul>                    
                    </div>

                @endif
            </div>
        </div>

        


        <div class="modal fade" id="modal_avaliacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Avaliação</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('avaliador_avaliar')}}" method="POST">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="tarefa_id" id="tarefa_id">
                        <input type="hidden" name="professor_id" id="professor_id">
                        <input type="hidden" name="status" id="status">
                        <input type="hidden" name="atividade_type" id="atividade_type">
                        <input type="hidden" name="avaliacao_id" id="avaliacao_id_reprovar">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="hora_reajuste">Hora de reajuste:</label>
                                <input class="form-control" type="number" name="hora_reajuste" id="hora_reajuste"><br>
                            </div>
                            <div class="form-group">
                                <label for="descricao">Descrição:</label>
                                <input class="form-control" type="textarea" name="descricao" id="descricao">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-outline-danger" value="Reprovar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

<script>
    function setaDadosModalAvaliacao(tarefa_id, professor_id, status, atividade_type, avaliacao_id){
        console.log(document.getElementById('avaliacao_id_reprovar'));
        document.getElementById('tarefa_id').value = tarefa_id;
        document.getElementById('professor_id').value = professor_id;
        document.getElementById('status').value = status;
        document.getElementById('atividade_type').value = atividade_type;
        document.getElementById('avaliacao_id_reprovar').value = avaliacao_id;
        console.log(document.getElementById('avaliacao_id_reprovar'));

    }
</script>
