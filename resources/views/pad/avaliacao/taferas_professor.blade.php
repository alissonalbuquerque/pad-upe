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

        <h3>{{$professor->name}}</h3><br><br>

        @if (isset($ensino) && !empty($ensino))
            <h4><strong>Ensino</strong></h4>

            @foreach ($ensino as $tarefa)
                <div class="card">
                    <h5 class="card-header">Cód. Atividade - {{$tarefa["cod_atividade"]}}</h5>
                    <div class="card-body">
                        <span class="fw-bold ">Componente Curricular: </span><span class="card-text">{{isset($tarefa["componente_curricular"])?$tarefa["componente_curricular"]:"--"}}</span><br>
                        <span class="fw-bold ">Curso: </span><span class="card-text">{{isset($tarefa["curso"])?$tarefa["curso"]:"--"}}</span><br>
                        <span class="fw-bold ">Nível: </span><span class="card-text">{{isset($tarefa["nivel"])?$niveis[$tarefa["nivel"]]:"--"}}</span><br>
                        <span class="fw-bold ">Modalidade: </span><span class="card-text">{{isset($tarefa["modalidade"])?$modalidades[$tarefa["modalidade"]]:"--"}}</span><br>
                        <span class="fw-bold ">Resolução: </span><span class="card-text">{{isset($tarefa["resolucao"])?$tarefa["resolucao"]:"--"}}</span><br>
                        <span class="fw-bold ">CH. Semanal: </span><span class="card-text">{{isset($tarefa["ch_semanal"])?$tarefa["ch_semanal"]:"--"}}</span><br>

                        <div style="width: 100%; " class="btns-avaliar mt-5 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal_avaliacao" style="height: 38px;" onclick='setaDadosModalAvaliacao("{{$tarefa["id"]}}", "{{$professor["id"]}}", "6", "{{$tarefa["tipo_atividade"]}}")'>
                                Reprovar
                            </button>

                            <span>&nbsp;&nbsp;</span>

                            <form action="{{route('avaliador_avaliar')}}" method="POST">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="tarefa_id" id="tarefa_id_aprovar" value="{{$tarefa["id"]}}">
                                <input type="hidden" name="professor_id" id="professor_id_aprovar" value="{{$professor["id"]}}">
                                <input type="hidden" name="status" id="status_aprovar" value='7'>
                                <input type="hidden" name="atividade_type" id="atividade_type_aprovar" value="{{$tarefa["tipo_atividade"]}}">
                                <input type="submit" class="btn btn-primary" value="Aprovar">
                            </form>
                        </div>
                    </div>
                </div><br>
            @endforeach

        @endif

        @if (isset($pesquisa) && !empty($pesquisa))
            <h4><strong>Pesquisa</strong></h4>

            @foreach ($pesquisa as $tarefa)
                <div class="card">
                    <h5 class="card-header">Cód. Atividade - {{$tarefa["cod_atividade"]}}</h5>
                    <div class="card-body">
                        <span class="fw-bold ">Título do Projeto: </span><span class="card-text">{{isset($tarefa["titulo_projeto"])?$tarefa["titulo_projeto"]:"--"}}</span><br>
                        <span class="fw-bold ">Componente Curricular: </span><span class="card-text">{{isset($tarefa["componente_curricular"])?$tarefa["componente_curricular"]:"--"}}</span><br>
                        <span class="fw-bold ">Curso: </span><span class="card-text">{{isset($tarefa["curso"])?$tarefa["curso"]:"--"}}</span><br>
                        <span class="fw-bold ">Nível: </span><span class="card-text">{{isset($tarefa["nivel"])?$niveis[$tarefa["nivel"]]:"--"}}</span><br>
                        <span class="fw-bold ">Modalidade: </span><span class="card-text">{{isset($tarefa["modalidade"])?$modalidades[$tarefa["modalidade"]]:"--"}}</span><br>
                        <span class="fw-bold ">Resolução: </span><span class="card-text">{{isset($tarefa["resolucao"])?$tarefa["resolucao"]:"--"}}</span><br>
                        <span class="fw-bold ">CH. Semanal: </span><span class="card-text">{{isset($tarefa["ch_semanal"])?$tarefa["ch_semanal"]:"--"}}</span><br>

                        <div style="width: 100%; " class="btns-avaliar mt-5 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal_avaliacao" onclick='setaDadosModalAvaliacao("{{$tarefa["id"]}}", "{{$professor["id"]}}", "6", "{{$tarefa["tipo_atividade"]}}")'>
                                Reprovar
                            </button>

                            <span>&nbsp;&nbsp;</span>

                            <form action="{{route('avaliador_avaliar')}}" method="POST">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="tarefa_id" id="tarefa_id_aprovar" value="{{$tarefa["id"]}}">
                                <input type="hidden" name="professor_id" id="professor_id_aprovar" value="{{$professor["id"]}}">
                                <input type="hidden" name="status" id="status_aprovar" value='7'>
                                <input type="hidden" name="atividade_type" id="atividade_type_aprovar" value="{{$tarefa["tipo_atividade"]}}">
                                <input type="submit" class="btn btn-primary" value="Aprovar">
                            </form>

                        </div>
                    </div>
                </div><br>
            @endforeach

        @endif

        @if (isset($extensao) && !empty($extensao))
            <h4><strong>Extensão</strong></h4>

            @foreach ($extensao as $tarefa)
                <div class="card">
                    <h5 class="card-header">Cód. Atividade - {{$tarefa["cod_atividade"]}}</h5>
                    <div class="card-body">
                        <span class="fw-bold ">Título do Projeto: </span><span class="card-text">{{isset($tarefa["titulo_projeto"])?$tarefa["titulo_projeto"]:"--"}}</span><br>
                        <span class="fw-bold ">Componente Curricular: </span><span class="card-text">{{isset($tarefa["componente_curricular"])?$tarefa["componente_curricular"]:"--"}}</span><br>
                        <span class="fw-bold ">Curso: </span><span class="card-text">{{isset($tarefa["curso"])?$tarefa["curso"]:"--"}}</span><br>
                        <span class="fw-bold ">Nível: </span><span class="card-text">{{isset($tarefa["nivel"])?$niveis[$tarefa["nivel"]]:"--"}}</span><br>
                        <span class="fw-bold ">Modalidade: </span><span class="card-text">{{isset($tarefa["modalidade"])?$modalidades[$tarefa["modalidade"]]:"--"}}</span><br>
                        <span class="fw-bold ">Resolução: </span><span class="card-text">{{isset($tarefa["resolucao"])?$tarefa["resolucao"]:"--"}}</span><br>
                        <span class="fw-bold ">CH. Semanal: </span><span class="card-text">{{isset($tarefa["ch_semanal"])?$tarefa["ch_semanal"]:"--"}}</span><br>

                        <div style="width: 100%; " class="btns-avaliar mt-5 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal_avaliacao" onclick='setaDadosModalAvaliacao("{{$tarefa["id"]}}", "{{$professor["id"]}}", "6", "{{$tarefa["tipo_atividade"]}}")'>
                                Reprovar
                            </button>

                            <span>&nbsp;&nbsp;</span>

                            <form action="{{route('avaliador_avaliar')}}" method="POST">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="tarefa_id" id="tarefa_id_aprovar" value="{{$tarefa["id"]}}">
                                <input type="hidden" name="professor_id" id="professor_id_aprovar" value="{{$professor["id"]}}">
                                <input type="hidden" name="status" id="status_aprovar" value='7'>
                                <input type="hidden" name="atividade_type" id="atividade_type_aprovar" value="{{$tarefa["tipo_atividade"]}}">
                                <input type="submit" class="btn btn-primary" value="Aprovar">
                            </form>

                        </div>
                    </div>
                </div><br>
            @endforeach

        @endif

        @if (isset($gestao) && !empty($gestao))
            <h4><strong>Gestão</strong></h4>

            @foreach ($gestao as $tarefa)
                <div class="card">
                    <h5 class="card-header">Cód. Atividade - {{$tarefa["cod_atividade"]}}</h5>
                    <div class="card-body">
                        <span class="fw-bold ">Título do Projeto: </span><span class="card-text">{{isset($tarefa["titulo_projeto"])?$tarefa["titulo_projeto"]:"--"}}</span><br>
                        <span class="fw-bold ">Componente Curricular: </span><span class="card-text">{{isset($tarefa["componente_curricular"])?$tarefa["componente_curricular"]:"--"}}</span><br>
                        <span class="fw-bold ">Curso: </span><span class="card-text">{{isset($tarefa["curso"])?$tarefa["curso"]:"--"}}</span><br>
                        <span class="fw-bold ">Nível: </span><span class="card-text">{{isset($tarefa["nivel"])?$niveis[$tarefa["nivel"]]:"--"}}</span><br>
                        <span class="fw-bold ">Modalidade: </span><span class="card-text">{{isset($tarefa["modalidade"])?$modalidades[$tarefa["modalidade"]]:"--"}}</span><br>
                        <span class="fw-bold ">Resolução: </span><span class="card-text">{{isset($tarefa["resolucao"])?$tarefa["resolucao"]:"--"}}</span><br>
                        <span class="fw-bold ">CH. Semanal: </span><span class="card-text">{{isset($tarefa["ch_semanal"])?$tarefa["ch_semanal"]:"--"}}</span><br>

                        <div style="width: 100%; " class="btns-avaliar mt-5 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal_avaliacao" onclick='setaDadosModalAvaliacao("{{$tarefa["id"]}}", "{{$professor["id"]}}", "6", "{{$tarefa["tipo_atividade"]}}")'>
                                Reprovar
                            </button>

                            <span>&nbsp;&nbsp;</span>

                            <form action="{{route('avaliador_avaliar')}}" method="POST">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="tarefa_id" id="tarefa_id_aprovar" value="{{$tarefa["id"]}}">
                                <input type="hidden" name="professor_id" id="professor_id_aprovar" value="{{$professor["id"]}}">
                                <input type="hidden" name="status" id="status_aprovar" value='7'>
                                <input type="hidden" name="atividade_type" id="atividade_type_aprovar" value="{{$tarefa["tipo_atividade"]}}">
                                <input type="submit" class="btn btn-primary" value="Aprovar">
                            </form>

                        </div>
                    </div>
                </div><br>
            @endforeach

        @endif

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

@endsection

<script>
    function setaDadosModalAvaliacao(tarefa_id, professor_id, status, atividade_type){
        document.getElementById('tarefa_id').value = tarefa_id;
        document.getElementById('professor_id').value = professor_id;
        document.getElementById('status').value = status;
        document.getElementById('atividade_type').value = atividade_type;
    }
</script>