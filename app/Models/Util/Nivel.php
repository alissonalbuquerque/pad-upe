<?php

namespace App\Models\Util;


class Nivel
{
    const GRADUACAO = 1;
    const POS_GRADUACAO_STRICTO_SENSU = 2;
    const POS_GRADUACAO_LATO_SENSU = 3;

    /**
     * @return array|string
     */
    public static function listNivel($value = null) {
        $values = [
            self::GRADUACAO => 'Graduação',
            self::POS_GRADUACAO_STRICTO_SENSU => 'Pós-Graduação Stricto Sensu',
            self::POS_GRADUACAO_LATO_SENSU => 'Pós-graduação Lato Sensu',

        ];

        return $value !== null? $values[$value] : $values;
    }
    
}
