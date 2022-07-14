<?php

namespace App\Models\Util;

class PadTables {

    public static function tablesEnsino() {
        return [
            ['id' => 'ensino_aulas', 'name' => '1. ENSINO (AULAS EM COMPONENTES CURRICULARES)'],
            ['id' => 'ensino_coordenacao_disciplina', 'name' => '2. ENSINO (COORDENAÇÃO/ REGÊNCIA COMPONENTES CURRICULARES)'],
            ['id' => 'ensino_orientacao', 'name' => '3. ENSINO (ORIENTAÇÕES: ORIENTAÇÃO DE ESTÁGIO, ORIENTAÇÃO DE TCC, ORIENTAÇÃO DE RESIDÊNCIA, ORIENTAÇÃO DE MESTRADO E/OU ORIENTAÇÃO DE DOUTORADO. COORIENTAÇÕES: TCC, MESTRADO E/OU DOUTORADO)'],
            ['id' => 'ensino_supervisao', 'name' => '4. ENSINO (SUPERVISÕES: SUPERVISÃO/PRECEPTORIA DE ESTÁGIO, SUPERVISÃO DE ESTÁGIO DOCENCIA, SUPERVISÃO/TUTORIA DE RESIDÊNCIA)'],
            ['id' => 'ensino_atendimento_discente', 'name' => '.5 ENSINO – ATENDIMENTO AO DISCENTE (O DOCENTE DEVERÁ PUBLICAR NA UNIDADE OS DIAS, HORÁRIOS E LOCAIS QUE PRESTARÁ O ATENDIMENTO)'],
            ['id' => 'ensino_projeto', 'name' => '6. ENSINO (PROJETOS OU AÇÕES DE ENSINO)'],
            ['id' => 'ensino_participacao', 'name' => '7. ENSINO (PARTICIPAÇÃO NAS REUNIÕES DOS COLEGIADOS DE PLENO DE CURSO DE GRADUAÇÃO E PÓS-GRADUAÇÃO)'],
            ['id' => 'ensino_coordenacao_docente', 'name' => '8. ENSINO (COORDENAÇÃO OU MEMBRO DE NÚCLEO DOCENTE ESTRUTURANTE OU NÚCLEO DOCENTE ESTRUTURANTE ASSISTENCIAL)'],
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