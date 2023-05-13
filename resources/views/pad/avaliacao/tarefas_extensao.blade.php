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
                <a  href="{{Route('pad_professor_atividades', ['id'=> $pad->id, 'professor_id'=> $professor->id, 'aba'=>'ensino'])}}" 
                    class="nav-link" id="profile-tab"  
                    type="button" role="tab" 
                    aria-controls="profile" 
                    aria-selected="false">
                    Ensino</a>            </li>
            
            <li class="nav-item" role="presentation">
                <a  href="{{Route('pad_professor_atividades', ['id'=> $pad->id, 'professor_id'=> $professor->id, 'aba'=>'pesquisa'])}}" 
                    class="nav-link" id="profile-tab"  
                    type="button" role="tab" 
                    aria-controls="profile" 
                    aria-selected="false">
                    Pesquisa</a>
            </li>
            
            <li class="nav-item" role="presentation">
            <a  href="{{Route('pad_professor_atividades', ['id'=> $pad->id, 'professor_id'=> $professor->id, 'aba'=>'extensao'])}}"
                class="nav-link active"
                id="profile-tab"
                type="button"
                role="tab"
                aria-controls="profile"
                aria-selected="false">
                Extensao</a>
            </li>

            <li class="nav-item" role="presentation">
                <a  href="{{Route('pad_professor_atividades', ['id'=> $pad->id, 'professor_id'=> $professor->id, 'aba'=>'gestao'])}}" 
                    class="nav-link" 
                    id="profile-tab"
                    type="button"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="false">
                    Gestão</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Extensao -->
            <div class="tab-pane fade show active" id="ensino" role="tabpanel" aria-labelledby="ensino-tab">       
                @if (isset($avaliacoes_extensao) && !empty($avaliacoes_extensao[0]))
                    @foreach ($avaliacoes_extensao as $avaliacao)
                        <div class="card">
                            <h5 class="card-header">{{$avaliacao->tarefa->getDescricaoAtividade()}}  ({{$avaliacao->tarefa->cod_atividade}})</h5>

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
                                @else
                                <div class="btns-avaliar mt-4 d-flex justify-content-end">
                                    <form action="{{route('avaliador_avaliar')}}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <input type="hidden" name="avaliacao_id" id="avaliacao_id_cancelar" value="{{$avaliacao->id}}">
                                        <input type="hidden" name="tarefa_id" id="tarefa_id_cancelar" value="{{$avaliacao->tarefa->id}}">
                                        <input type="hidden" name="professor_id" id="professor_id_cancelar" value="{{$avaliacao->tarefa->userPad->user->id}}">
                                        <input type="hidden" name="status" id="status_cancelar" value='3'>
                                        <input type="hidden" name="atividade_type" id="atividade_type_cancelar" value="{{$avaliacao->type}}">
                                        <input type="submit" class="btn btn-secondary" value="Cancelar Avaliação">
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
                @else
                    <div class="container col-sm-6">
                        <div class="card">
                            <div class="card-header" style="height:40px;"></div>
                            <div class="card-body" style="margin-top:10px;">
                                <div class="row justify-content-center">
                                    <h4 style="text-align:center;">Não existem atividades desta categoria cadastradas! </h4>
                                </div>
                            </div>
                        </div>
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
