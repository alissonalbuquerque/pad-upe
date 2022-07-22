<?php

namespace App\Models\Util;


class Modalidade
{
    const EAD = 1;
    const PRESENCIAL = 2;

    /**
    * @return array|string
    */
    public static function listModalidade($value = null) {
        $values = [
            self::EAD => 'EAD',
            self::PRESENCIAL => 'Presencial',

        ];

        return $value !== null? $values[$value] : $values;
    }
}
