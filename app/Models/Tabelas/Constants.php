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
    const FUNCAO_MEMBRO = 3;

    const NATUREZA_INOVACAO = 1;
    const NATUREZA_PEDAGOGICA = 2;
    const NATUREZA_VIVENCIA = 4;
    const NATUREZA_OUTROS = 5;


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
    public function listOrientacao($value = null) {
        $values = [
            self::ORIENTACAO_GRUPO => 'Grupo',
            self::ORIENTACAO_INDIVIDUAL => 'Individual',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public function listFuncao($value = null) {
        $values = [
            self::FUNCAO_COORDENADOR => 'Coordenador',
            self::FUNCAO_COLABORADOR => 'Colaborador',
            self::FUNCAO_MEMBRO => 'Membro',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public function listNatureza($value = null) {
        $values = [
            self::NATUREZA_INOVACAO => 'Inovação',
            self::NATUREZA_PEDAGOGICA => 'Pedagógica',
            self::NATUREZA_VIVENCIA => 'Vivência',
            self::NATUREZA_OUTROS => 'Outros'
        ];
        
        return $value !== null? $values[$value] : $values;
    }
    
    
    
    
}