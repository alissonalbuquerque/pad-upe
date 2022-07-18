<?php

namespace App\Models\Util;

class PadTables {

    const TYPE_ENSINO = 0;
    const TYPE_EXTENSAO = 1;
    const TYPE_PESQUISA = 2;
    const TYPE_GESTAO = 3;

    public static function tablesEnsino() {
        return [
            ['id' => 'ensino_aulas', 'name' => 'ENSINO (AULAS EM COMPONENTES CURRICULARES)'],
            ['id' => 'ensino_coordenacao_disciplina', 'name' => 'ENSINO (COORDENAÇÃO/ REGÊNCIA COMPONENTES CURRICULARES)'],
            ['id' => 'ensino_orientacao', 'name' => 'ENSINO (ORIENTAÇÕES: ORIENTAÇÃO DE ESTÁGIO, ORIENTAÇÃO DE TCC, ORIENTAÇÃO DE RESIDÊNCIA, ORIENTAÇÃO DE MESTRADO E/OU ORIENTAÇÃO DE DOUTORADO. COORIENTAÇÕES: TCC, MESTRADO E/OU DOUTORADO)'],
            ['id' => 'ensino_supervisao', 'name' => 'ENSINO (SUPERVISÕES: SUPERVISÃO/PRECEPTORIA DE ESTÁGIO, SUPERVISÃO DE ESTÁGIO DOCENCIA, SUPERVISÃO/TUTORIA DE RESIDÊNCIA)'],
            ['id' => 'ensino_atendimento_discente', 'name' => 'ENSINO – ATENDIMENTO AO DISCENTE (O DOCENTE DEVERÁ PUBLICAR NA UNIDADE OS DIAS, HORÁRIOS E LOCAIS QUE PRESTARÁ O ATENDIMENTO)'],
            ['id' => 'ensino_projeto', 'name' => 'ENSINO (PROJETOS OU AÇÕES DE ENSINO)'],
            ['id' => 'ensino_participacao', 'name' => 'ENSINO (PARTICIPAÇÃO NAS REUNIÕES DOS COLEGIADOS DE PLENO DE CURSO DE GRADUAÇÃO E PÓS-GRADUAÇÃO)'],
            ['id' => 'ensino_coordenacao_docente', 'name' => 'ENSINO (COORDENAÇÃO OU MEMBRO DE NÚCLEO DOCENTE ESTRUTURANTE OU NÚCLEO DOCENTE ESTRUTURANTE ASSISTENCIAL)'],
        ];
    }

    public static function tablesPesquisa() {
        return [
            
        ];
    }

    public static function tablesExtensao() {
        return [

        ];
    }

    public static function tablesGestao() {
        return [

        ];
    }

}