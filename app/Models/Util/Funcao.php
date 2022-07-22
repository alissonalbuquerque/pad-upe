<?php

namespace App\Models\Util;


class Funcao
{
    const COORDENADOR = 1;
    const COLABORADOR = 2;
    const ORIENTADOR = 4;
    const CO_ORIENTADOR = 5;
    const MEMBRO = 6;

    /**
     * @return array|string
     */
    public static function listFuncaoEnsino($value = null) {
        $values = [
            self::COORDENADOR => 'Coordenador',
            self::MEMBRO => 'Membro',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public static function listFuncaoOrientador($value = null) {
        $values = [
            self::ORIENTADOR => 'Orientador',
            self::CO_ORIENTADOR => 'Coorientador',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

    /**
     * @return array|string
     */
    public static function listFuncaoProjeto($value = null) {
        $values = [
            self::COORDENADOR => 'Coordenador',
            self::COLABORADOR => 'Colaborador',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

}
