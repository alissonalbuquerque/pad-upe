<?php

namespace App\Models\Util;

class PadTables {

    public static function tablesEnsino() {
        return [
            ['id' => 'ensino_aulas', 'name' => '1. ENSINO (AULAS EM COMPONENTES CURRICULARES)'],
            ['id' => 'ensino_coordenacao_disciplina', 'name' => '2. ENSINO (COORDENAÇÃO/ REGÊNCIA COMPONENTES CURRICULARES)'],
            ['id' => 'ensino_orientacao', 'name' => '3. ENSINO (ORIENTAÇÕES: ORIENTAÇÃO DE ESTÁGIO, ORIENTAÇÃO DE TCC, ORIENTAÇÃO DE RESIDÊNCIA, ORIENTAÇÃO DE MESTRADO E/OU ORIENTAÇÃO DE DOUTORADO. COORIENTAÇÕES: TCC, MESTRADO E/OU DOUTORADO)'],
            ['id' => 'ensino_supervisao', 'name' => '4. ENSINO (SUPERVISÕES: SUPERVISÃO/PRECEPTORIA DE ESTÁGIO, SUPERVISÃO DE ESTÁGIO DOCENCIA, SUPERVISÃO/TUTORIA DE RESIDÊNCIA)'],
            ['id' => 'ensino_atendimento_discente', 'name' => '5. ENSINO – ATENDIMENTO AO DISCENTE (O DOCENTE DEVERÁ PUBLICAR NA UNIDADE OS DIAS, HORÁRIOS E LOCAIS QUE PRESTARÁ O ATENDIMENTO)'],
            ['id' => 'ensino_projeto', 'name' => '6. ENSINO (PROJETOS OU AÇÕES DE ENSINO)'],
            ['id' => 'ensino_participacao', 'name' => '7. ENSINO (PARTICIPAÇÃO NAS REUNIÕES DOS COLEGIADOS DE PLENO DE CURSO DE GRADUAÇÃO E PÓS-GRADUAÇÃO)'],
            ['id' => 'ensino_coordenacao_docente', 'name' => '8. ENSINO (COORDENAÇÃO OU MEMBRO DE NÚCLEO DOCENTE ESTRUTURANTE OU NÚCLEO DOCENTE ESTRUTURANTE ASSISTENCIAL)'],
        ];
    }

    public static function tablesPesquisa() {
        return [
            ['id' => 'pesquisa_coordenacao', 'name' => '1. PESQUISA (COORDENAÇÃO OU PARTICIPAÇÃO EM PROJETOS DE PESQUISA CADASTRADOS NO SISPG)'],
            ['id' => 'pesquisa_lideranca', 'name' => '2. PESQUISA (LIDERANÇA OU PARTICIPAÇÃO EM GRUPOS DE PESQUISA CERTIFICADOS PELA UPE)'],
            ['id' => 'pesquisa_orientacao', 'name' => '3. PESQUISA (ORIENTAÇÃO DE INICIAÇÃO CIENTÍFICA DE PROJETOS VINCULADOS CADASTRADOS NO SISPG)'],
        ];
    }

    public static function tablesExtensao() {
        return [
            ['id' => 'extensao_coordenacao', 'name' => '1. EXTENSÃO (COORDENAÇÃO OU PARTICIPAÇÃO EM ATIVIDADES DE EXTENSÃO HOMOLOGADAS PELA PROEC)'],
            ['id' => 'extensao_orientacao', 'name' => '2. EXTENSÃO (ORIENTAÇÃO OU ACOMPANHAMENTO DE ESTUDANTES EM ATIVIDADES DE EXTENSÃO HOMOLOGADAS PELA PROEC)'],
        ];
    }

    public static function tablesGestao() {
        return [
            ['id' => 'gestao_membro_comissao', 'name' => '1. GESTÃO (MEMBRO DE COMISSÃO/COMITÊ/NÚCLEO, FORMALMENTE DESIGNADO(A) NO  MBITO DA UPE)'],
            ['id' => 'gestao_membro_conselho', 'name' => '2. GESTÃO (MEMBRO DE CONSELHO/COMISSÃO/COMITÊ/NÚCLEO, FORMALMENTE DESIGNADO (A) PARA REPRESENTAÇÃO DA UPE)'],
            ['id' => 'gestao_membro_titular_conselho', 'name' => '3. GESTÃO (MEMBRO TITULAR DOS CONSELHOS DA UPE (CEPE, CONSUN OU CGA))'],
            ['id' => 'gestao_representante_unidade_educacao', 'name' => '4. GESTÃO (REPRESENTANTE NAS UNIDADES DE EDUCAÇÃO OU DE EDUCAÇÃO E SAÚDE FORMALMENTE DESIGNADO (A) PELA ENTIDADE SINDICAL)'],
            ['id' => 'gestao_membro_camaras', 'name' => '5. GESTÃO (PARTICIPAÇÃO COMO MEMBRO NAS CÂMARAS CONSULTIVAS DOS CONSELHOS SUPERIORES)'],
            ['id' => 'gestao_coordenacao_laboratorios_didaticos', 'name' => '6. GESTÃO (COORDENAÇÃO DE LABORATÓRIOS DIDÁTICOS, DE INFORMÁTICA OU DE ENSINO)'],
            ['id' => 'gestao_coordenacao_programa_institucional', 'name' => '7. GESTÃO (COORDENAÇÃO DE PROGRAMA INSTITUCIONAL)'],
        ];
    }

}