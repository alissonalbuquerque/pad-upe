@extends('layouts.main')

@section('title', 'Atividades Reprovadas')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', [
        'menu' => $menu,
    ])
@endsection

@section('body')

    <ul class="nav nav-tabs" id="nav-tasks" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="ensino-tab" data-bs-toggle="tab" data-bs-target="#ensino-session" type="button" role="tab" aria-controls="ensino-session" aria-selected="true">Ensino</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pesquisa-tab" data-bs-toggle="tab" data-bs-target="#pesquisa-session" type="button" role="tab" aria-controls="pesquisa-session" aria-selected="false">Pesquisa</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="extensao-tab" data-bs-toggle="tab" data-bs-target="#extensao-session" type="button" role="tab" aria-controls="extensao-session" aria-selected="false">Extensão</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="gestao-tab" data-bs-toggle="tab" data-bs-target="#gestao-session" type="button" role="tab" aria-controls="gestao-session" aria-selected="false">Gestão</button>
        </li>
    </ul>

    <div class="tab-content" id="containner-dimension">
        <div class="tab-pane fade show active" id="ensino-session" role="tabpanel" aria-labelledby="ensino-tab">

            @foreach($ensinoAtendimentoDiscentes as $ensinoAtendimentoDiscente)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_atendimento_discente', ['model' => $ensinoAtendimentoDiscente])
            @endforeach

            @foreach($ensinoCoordenacaoRegencias as $ensinoCoordenacaoRegencia)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_coordenacao_regencia', ['model' => $ensinoCoordenacaoRegencia])
            @endforeach

            @foreach($ensinoOrientacoes as $ensinoOrientacao)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_orientacao', ['model' => $ensinoOrientacao])
            @endforeach

            @foreach($ensinoParticipacoes as $ensinoParticipacao)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_participacao', ['model' => $ensinoParticipacao])
            @endforeach

            @foreach($ensinoSupervisoes as $ensinoSupervisao)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_supervisao', ['model' => $ensinoSupervisao])
            @endforeach

            @foreach($ensinoAulas as $ensinoAula)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_aula', ['model' => $ensinoAula])
            @endforeach

            @foreach($ensinoMembroDocentes as $ensinoMembroDocente)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_membro_docente', ['model' => $ensinoMembroDocente])
            @endforeach

            @foreach($ensinoOutros as $ensinoOutro)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_outro', ['model' => $ensinoOutro])
            @endforeach

            @foreach($ensinoProjetos as $ensinoProjeto)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_projeto', ['model' => $ensinoProjeto])
            @endforeach

        </div>

        <div class="tab-pane" id="pesquisa-session" role="tabpanel" aria-labelledby="pesquisa-tab">
            
            @foreach($pesquisaCoordenacoes as $pesquisaCoordenacao)

            @endforeach

            @foreach($pesquisaLiderancas as $pesquisaLideranca)

            @endforeach

            @foreach($pesquisaOrientacoes as $pesquisaOrientacao)

            @endforeach

            @foreach($pesquisaOutros as $pesquisaOutro)

            @endforeach        

        </div>

        <div class="tab-pane" id="extensao-session" role="tabpanel" aria-labelledby="extensao-tab">
            
            @foreach($extensaoCoordenacoes as $extensaoCoordenacao)

            @endforeach 
            
            @foreach($extensaoOrientacoes as $extensaoOrientacao)

            @endforeach 

            @foreach($extensaoOutros as $extensaoOutro)

            @endforeach 
            
        </div>

        <div class="tab-pane" id="gestao-session" role="tabpanel" aria-labelledby="gestao-tab">
            
            @foreach($gestaoCoordenacaoLaboratoriosDidaticos as $gestaoCoordenacaoLaboratoriosDidatico)

            @endforeach

            @foreach($gestaoMembroComissoes as $gestaoMembroComissao)

            @endforeach

            @foreach($gestaoOutros as $gestaoOutro)

            @endforeach

            @foreach($gestaoCoordenacaoProgramaInstitucionais as $gestaoCoordenacaoProgramaInstitucional)

            @endforeach

            @foreach($gestaoMembroConselhos as $gestaoMembroConselho)

            @endforeach

            @foreach($gestaoRepresentanteUnidadeEducacoes as $gestaoRepresentanteUnidadeEducacao)

            @endforeach

            @foreach($gestaoMembroCamaras as $gestaoMembroCamara)

            @endforeach

            @foreach($gestaoMembroTitularConselhos as $gestaoMembroTitularConselho)

            @endforeach

        </div>
    </div>

@endsection
