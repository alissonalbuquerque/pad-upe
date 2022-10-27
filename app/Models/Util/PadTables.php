<?php

namespace App\Models\Util;

class PadTables {

    const TYPE_ENSINO = 1;
    const TYPE_EXTENSAO = 2;
    const TYPE_PESQUISA = 3;
    const TYPE_GESTAO = 4;

    public static function tablesEnsino($user_pad_id) {
        return [
            [
                'id' => 'ensino_aula',
                'name' => '1. ENSINO (AULAS EM COMPONENTES CURRICULARES)',
                'route' => route('ensino_aula_index', ['user_pad_id' => $user_pad_id])

            ],
            [   'id' => 'ensino_coordenacao_regencia',
                'name' => '2. ENSINO (COORDENAÇÃO/ REGÊNCIA COMPONENTES CURRICULARES)',
                'route' => route('ensino_coordenacao_regencia_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'ensino_orientacao',
                'name' => '3. ENSINO (ORIENTAÇÕES: ORIENTAÇÃO DE ESTÁGIO, ORIENTAÇÃO DE TCC, ORIENTAÇÃO DE RESIDÊNCIA, ORIENTAÇÃO DE MESTRADO E/OU ORIENTAÇÃO DE DOUTORADO. COORIENTAÇÕES: TCC, MESTRADO E/OU DOUTORADO)',
                'route' => route('ensino_orientacao_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'ensino_supervisao',
                'name' => '4. ENSINO (SUPERVISÕES: SUPERVISÃO/PRECEPTORIA DE ESTÁGIO, SUPERVISÃO DE ESTÁGIO DOCENCIA, SUPERVISÃO/TUTORIA DE RESIDÊNCIA)',
                'route' => route('ensino_supervisao_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'ensino_atendimento_discente',
                'name' => '5. ENSINO – ATENDIMENTO AO DISCENTE (O DOCENTE DEVERÁ PUBLICAR NA UNIDADE OS DIAS, HORÁRIOS E LOCAIS QUE PRESTARÁ O ATENDIMENTO)',
                'route' => route('ensino_atendimento_discente_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'ensino_projeto',
                'name' => '6. ENSINO (PROJETOS OU AÇÕES DE ENSINO)',
                'route' => route('ensino_projeto_index', ['user_pad_id' => $user_pad_id])

            ],
            [
                'id' => 'ensino_participacao',
                'name' => '7. ENSINO (PARTICIPAÇÃO NAS REUNIÕES DOS COLEGIADOS DE PLENO DE CURSO DE GRADUAÇÃO E PÓS-GRADUAÇÃO)',
                'route' => route('ensino_participacao_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'ensino_membro_docente',
                'name' => '8. ENSINO (COORDENAÇÃO OU MEMBRO DE NÚCLEO DOCENTE ESTRUTURANTE OU NÚCLEO DOCENTE ESTRUTURANTE ASSISTENCIAL)',
                'route' => route('ensino_membro_docente_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'ensino_outros',
                'name' => '9. ENSINO (OUTROS)',
                'route' => route('ensino_outros_index', ['user_pad_id' => $user_pad_id])

            ],
        ];
    }

    public static function tablesPesquisa($user_pad_id) {
        return [
            [
                'id' => 'pesquisa_coordenacao',
                'name' => '1. PESQUISA (COORDENAÇÃO OU PARTICIPAÇÃO EM PROJETOS DE PESQUISA CADASTRADOS NO SISPG)',
                'route' => route('pesquisa_coordenacao_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'pesquisa_lideranca',
                'name' => '2. PESQUISA (LIDERANÇA OU PARTICIPAÇÃO EM GRUPOS DE PESQUISA CERTIFICADOS PELA UPE)',
                'route' => route('pesquisa_lideranca_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'pesquisa_orientacao',
                'name' => '3. PESQUISA (ORIENTAÇÃO DE INICIAÇÃO CIENTÍFICA DE PROJETOS VINCULADOS CADASTRADOS NO SISPG)',
                'route' => route('pesquisa_orientacao_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'pesquisa_outros',
                'name' => '4. PESQUISA (OUTROS)',
                'route' => route('pesquisa_outros_index', ['user_pad_id' => $user_pad_id])
            ],
        ];
    }

    public static function tablesExtensao($user_pad_id) {
        return [
            [
                'id' => 'extensao_coordenacao',
                'name' => '1. EXTENSÃO (COORDENAÇÃO OU PARTICIPAÇÃO EM ATIVIDADES DE EXTENSÃO HOMOLOGADAS PELA PROEC)',
                'route' => route('extensao_coordenacao_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'extensao_orientacao',
                'name' => '2. EXTENSÃO (ORIENTAÇÃO OU ACOMPANHAMENTO DE ESTUDANTES EM ATIVIDADES DE EXTENSÃO HOMOLOGADAS PELA PROEC)',
                'route' => route('extensao_orientacao_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'extensao_outros',
                'name' => '3. EXTENSÃO (OUTROS)',
                'route' => route('extensao_outros_index', ['user_pad_id' => $user_pad_id])
            ],
        ];
    }

    public static function tablesGestao($user_pad_id) {
        return [
            [   
                'id' => 'gestao_membro_comissao',
                'name' => '1. GESTÃO (MEMBRO DE COMISSÃO/COMITÊ/NÚCLEO, FORMALMENTE DESIGNADO(A) NO ÂMBITO DA UPE)',
                'route' => route('gestao_membro_comissao_index', ['user_pad_id' => $user_pad_id])
            ],
            [   
                'id' => 'gestao_membro_conselho',
                'name' => '2. GESTÃO (MEMBRO DE CONSELHO/COMISSÃO/COMITÊ/NÚCLEO, FORMALMENTE DESIGNADO (A) PARA REPRESENTAÇÃO DA UPE)',
                'route' => route('gestao_membro_conselho_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'gestao_membro_titular_conselho',
                'name' => '3. GESTÃO (MEMBRO TITULAR DOS CONSELHOS DA UPE (CEPE, CONSUN OU CGA))',
                'route' => route('gestao_membro_titular_conselho_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'gestao_representante_unidade_educacao',
                'name' => '4. GESTÃO (REPRESENTANTE NAS UNIDADES DE EDUCAÇÃO OU DE EDUCAÇÃO E SAÚDE FORMALMENTE DESIGNADO (A) PELA ENTIDADE SINDICAL)',
                'route' => route('gestao_representante_unidade_educacao_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'gestao_membro_camaras',
                'name' => '5. GESTÃO (PARTICIPAÇÃO COMO MEMBRO NAS CÂMARAS CONSULTIVAS DOS CONSELHOS SUPERIORES)',
                'route' => route('gestao_membro_camaras_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'gestao_coordenacao_laboratorios_didaticos',
                'name' => '6. GESTÃO (COORDENAÇÃO DE LABORATÓRIOS DIDÁTICOS, DE INFORMÁTICA OU DE ENSINO)',
                'route' => route('gestao_coordenacao_laboratorios_didaticos_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'gestao_coordenacao_programa_institucional',
                'name' => '7. GESTÃO (COORDENAÇÃO DE PROGRAMA INSTITUCIONAL)',
                'route' => route('gestao_coordenacao_programa_institucional_index', ['user_pad_id' => $user_pad_id])
            ],
            [
                'id' => 'gestao_outros',
                'name' => '8. GESTÃO (OUTROS)',
                'route' => route('gestao_outros_index', ['user_pad_id' => $user_pad_id])
            ],
        ];
    }

}