<?php

namespace App\Models\Util;

class CargaHoraria
{   
    public const CH_MIN = 'min:1';

    public static function create_ch_min(int $ch_min) {
        return sprintf('min:%d', $ch_min);
    }

    public static function create_ch_max(int $ch_max) {
        return sprintf('max:%d', $ch_max);
    }

    public static function ch_semanal($ch_min = self::CH_MIN, $ch_max = '')
    {   
        return ['required', 'integer', $ch_min, $ch_max];
    }
}