<?php

namespace App\Models\Tabelas;


class Constants {

    const NIVEL_GRADUACAO = 1;
    const NIVEL_POS_GRADUACAO_LATO_SENSU = 2;
    const NIVEL_POS_GRADUACAO_STRICTO_SENSU = 3;

    const MODALIDADE_EAD = 1;
    const MODALIDADE_PRESENCIAL = 2;

    const ORIENTACAO_GRUPO = 1;
    const ORIENTACAO_INDIVIDUAL = 2;

    const FUNCAO_COORDENADOR = 1;
    const FUNCAO_COLABORADOR = 2;
    const FUNCAO_ORIENTADOR = 4;
    const FUNCAO_CO_ORIENTADOR = 5;
    const FUNCAO_MEMBRO = 6;

    const NATUREZA_INOVACAO = 1;
    const NATUREZA_PEDAGOGICA = 2;
    const NATUREZA_VIVENCIA = 4;
    const NATUREZA_OUTROS = 5;

    const STATUS_ATIVO = 1;
    const STATUS_INATIVO = 2;
    const STATUS_ARQUIVADO = 3;

    const DIMENSAO_ENSINO = 1;
    const DIMENSAO_PESQUISA = 2;
    const DIMENSAO_EXTENSAO = 3;
    const DIMENSAO_GESTAO = 4;
    const DIMENSAO_ANEXO = 5; 


    /**
     * @return array|string
     */
    public static function listNivel($value = null) {
        $values = [
            self::NIVEL_GRADUACAO => 'Graduação',
            self::NIVEL_POS_GRADUACAO_LATO_SENSU => 'Pós-graduação Stricto Sensu',
            self::NIVEL_POS_GRADUACAO_STRICTO_SENSU => 'Pós-Graduação Lato Sensu',

        ];

        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public static function listModalidade($value = null) {
        $values = [
            self::MODALIDADE_EAD => 'EAD',
            self::MODALIDADE_PRESENCIAL => 'Presencial',

        ];

        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public static function listOrientacao($value = null) {
        $values = [
            self::ORIENTACAO_GRUPO => 'Grupo',
            self::ORIENTACAO_INDIVIDUAL => 'Individual',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public static function listFuncaoEnsino($value = null) {
        $values = [
            self::FUNCAO_COORDENADOR => 'Coordenador',
            self::FUNCAO_MEMBRO => 'Membro',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public static function listFuncaoOrientador($value = null) {
        $values = [
            self::FUNCAO_ORIENTADOR => 'Orientador',
            self::FUNCAO_CO_ORIENTADOR => 'Coorientador',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public static function listFuncaoProjeto($value = null) {
        $values = [
            self::FUNCAO_COORDENADOR => 'Coordenador',
            self::FUNCAO_COLABORADOR => 'Colaborador',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public static function listNatureza($value = null) {
        $values = [
            self::NATUREZA_INOVACAO => 'Inovação',
            self::NATUREZA_PEDAGOGICA => 'Pedagógica',
            self::NATUREZA_VIVENCIA => 'Vivência',
            self::NATUREZA_OUTROS => 'Outros'
        ];
        
        return $value !== null? $values[$value] : $values;
    }
    
    public static function listStatus($value = null) {
    
        $values = [
            self::STATUS_ATIVO => 'Ativo',
            self::STATUS_INATIVO => 'Inativo',
            self::STATUS_ARQUIVADO => 'Arquivado',
        ];
    
        return $value !== null? $values[$value] : $values;
    }

    public static function listDimensao($value = null) {
    
        $values = [
            self::DIMENSAO_ENSINO => 'Ensino',
            self::DIMENSAO_PESQUISA => 'Pesquisa',
            self::DIMENSAO_EXTENSAO => 'Extensão',
            self::DIMENSAO_GESTAO => 'Gestão',
            self::DIMENSAO_ANEXO => 'Anexo',
        ];
    
        return $value !== null? $values[$value] : $values;
    }
    
    
}