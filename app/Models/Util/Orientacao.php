<?php

namespace App\Models\Util;

class Orientacao
{
    const GRUPO = 1;
    const INDIVIDUAL = 2;

    /**
     * @return array|string
     */
    public static function listOrientacao($value = null) {
        $values = [
            self::GRUPO => 'Grupo',
            self::INDIVIDUAL => 'Individual',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

}
