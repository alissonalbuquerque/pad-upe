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

    <ul class="nav nav-tabs" id="tab-task" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="ensino-tab" data-bs-toggle="tab" data-bs-target="#ensino-content" type="button" role="tab" aria-controls="ensino-content" aria-selected="true">Ensino</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pesquisa-tab" data-bs-toggle="tab" data-bs-target="#pesquisa-content" type="button" role="tab" aria-controls="pesquisa-content" aria-selected="false">Pesquisa</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="extensao-tab" data-bs-toggle="tab" data-bs-target="#extensao-content" type="button" role="tab" aria-controls="extensao-content" aria-selected="false">Extensão</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="gestao-tab" data-bs-toggle="tab" data-bs-target="#gestao-content" type="button" role="tab" aria-controls="gestao-content" aria-selected="false">Gestão</button>
        </li>
    </ul>

    <div class="tab-content" id="tab-task-contente">

        <div class="tab-pane fade show active" id="ensino-content" role="tabpanel" aria-labelledby="ensino-tab">

            @foreach($avaliacoesEnsinoAtendimentoDiscentes as $ensinoAtendimentoDiscente)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_atendimento_discente', ['model' => $ensinoAtendimentoDiscente])
            @endforeach

            @foreach($avaliacoesEnsinoCoordenacaoRegencias as $ensinoCoordenacaoRegencia)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_coordenacao_regencia', ['model' => $ensinoCoordenacaoRegencia])
            @endforeach

            @foreach($avaliacoesEnsinoOrientacoes as $ensinoOrientacao)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_orientacao', ['model' => $ensinoOrientacao])
            @endforeach

            @foreach($avaliacoesEnsinoParticipacoes as $ensinoParticipacao)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_participacao', ['model' => $ensinoParticipacao])
            @endforeach

            @foreach($avaliacoesEnsinoSupervisoes as $ensinoSupervisao)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_supervisao', ['model' => $ensinoSupervisao])
            @endforeach

            @foreach($avaliacoesEnsinoAulas as $ensinoAula)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_aula', ['model' => $ensinoAula])
            @endforeach
                	
            @foreach($avaliacoesEnsinoMembroDocentes as $ensinoMembroDocente)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_membro_docente', ['model' => $ensinoMembroDocente])
            @endforeach

            @foreach($avaliacoesEnsinoOutros as $ensinoOutro)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_outro', ['model' => $ensinoOutro])
            @endforeach

            @foreach($avaliacoesEnsinoProjetos as $ensinoProjeto)
                @include('pad/dimensao/atividades/reprovadas/cards/ensino/ensino_projeto', ['model' => $ensinoProjeto])
            @endforeach
            
        </div>

        <div class="tab-pane fade" id="pesquisa-content" role="tabpanel" aria-labelledby="pesquisa-tab">
            
            @foreach($avaliacoesPesquisaCoordenacoes as $pesquisaCoordenacao)
                @include('pad/dimensao/atividades/reprovadas/cards/pesquisa/pesquisa_coordenacao', ['model' => $pesquisaCoordenacao])
            @endforeach

            @foreach($avaliacoesPesquisaLiderancas as $pesquisaLideranca)
                @include('pad/dimensao/atividades/reprovadas/cards/pesquisa/pesquisa_lideranca', ['model' => $pesquisaLideranca])
            @endforeach

            @foreach($avaliacoesPesquisaOrientacoes as $pesquisaOrientacao)
                @include('pad/dimensao/atividades/reprovadas/cards/pesquisa/pesquisa_orientacao', ['model' => $pesquisaOrientacao])
            @endforeach

            @foreach($avaliacoesPesquisaOutros as $pesquisaOutro)
                @include('pad/dimensao/atividades/reprovadas/cards/pesquisa/pesquisa_outro', ['model' => $pesquisaOutro])
            @endforeach

        </div>

        <div class="tab-pane fade" id="extensao-content" role="tabpanel" aria-labelledby="extensao-tab">
            
            @foreach($avaliacoesExtensaoCoordenacoes as $extensaoCoordenacao)
                @include('pad/dimensao/atividades/reprovadas/cards/extensao/extensao_coordenacao', ['model' => $extensaoCoordenacao])
            @endforeach
                        
            @foreach($avaliacoesExtensaoOrientacoes as $extensaoOrientacao)
                @include('pad/dimensao/atividades/reprovadas/cards/extensao/extensao_orientacao', ['model' => $extensaoOrientacao])
            @endforeach 

            @foreach($avaliacoesExtensaoOutros as $extensaoOutro)
                @include('pad/dimensao/atividades/reprovadas/cards/extensao/extensao_outro', ['model' => $extensaoOutro])
            @endforeach
            
        </div>

        <div class="tab-pane fade" id="gestao-content" role="tabpanel" aria-labelledby="gestao-tab">

            @foreach($avaliacoesGestaoCoordenacaoLaboratoriosDidaticos as $gestaoCoordenacaoLaboratoriosDidatico)
                @include('pad/dimensao/atividades/reprovadas/cards/gestao/gestao_coordenacao_laboratorio_didatico', ['model' => $gestaoCoordenacaoLaboratoriosDidatico])
            @endforeach
            
            @foreach($avaliacoesGestaoMembroComissoes as $gestaoMembroComissao)
                @include('pad/dimensao/atividades/reprovadas/cards/gestao/gestao_membro_comissao', ['model' => $gestaoMembroComissao])
            @endforeach
            
            @foreach($avaliacoesGestaoOutros as $gestaoOutro)
                @include('pad/dimensao/atividades/reprovadas/cards/gestao/gestao_outro', ['model' => $gestaoOutro])
            @endforeach
            
            @foreach($avaliacoesGestaoCoordenacaoProgramaInstitucionais as $gestaoCoordenacaoProgramaInstitucional)
                @include('pad/dimensao/atividades/reprovadas/cards/gestao/gestao_coordenacao_programa_institucional', ['model' => $gestaoCoordenacaoProgramaInstitucional])
            @endforeach

            @foreach($avaliacoesGestaoMembroConselhos as $gestaoMembroConselho)
                @include('pad/dimensao/atividades/reprovadas/cards/gestao/gestao_membro_conselho', ['model' => $gestaoMembroConselho])
            @endforeach
            
            @foreach($avaliacoesGestaoRepresentanteUnidadeEducacoes as $gestaoRepresentanteUnidadeEducacao)
                @include('pad/dimensao/atividades/reprovadas/cards/gestao/gestao_representante_unidade_educacao', ['model' => $gestaoRepresentanteUnidadeEducacao])
            @endforeach
            
            @foreach($avaliacoesGestaoMembroCamaras as $gestaoMembroCamara)
                @include('pad/dimensao/atividades/reprovadas/cards/gestao/gestao_membro_camara', ['model' => $gestaoMembroCamara])
            @endforeach
            
            @foreach($avaliacoesGestaoMembroTitularConselhos as $gestaoMembroTitularConselho)
                @include('pad/dimensao/atividades/reprovadas/cards/gestao/gestao_membro_titular_conselho', ['model' => $gestaoMembroTitularConselho])
            @endforeach

        </div>

    </div>
@endsection
