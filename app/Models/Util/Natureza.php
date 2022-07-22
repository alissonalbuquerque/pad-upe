<?php

namespace App\Models\Util;


class Natureza
{
    const INOVACAO = 1;
    const PEDAGOGICA = 2;
    const VIVENCIA = 4;
    const OUTROS = 5;

    /**
     * @return array|string
     */
    public static function listNatureza($value = null) {
        $values = [
            self::INOVACAO => 'Inovação',
            self::PEDAGOGICA => 'Pedagógica',
            self::VIVENCIA => 'Vivência',
            self::OUTROS => 'Outros'
        ];
        
        return $value !== null? $values[$value] : $values;
    }
}
