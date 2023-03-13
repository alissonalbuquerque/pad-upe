<?php

namespace App\Models\Util;

class YesOrNo
{   
    public const YES = 1;
    public const NO = 0;

    public static function listYesOrNo($value = null) {
    
        $values = [
            self::YES => 'SIM',
            self::NO => 'NÃO',
        ];
    
        return $value !== null? $values[$value] : $values;
    }
}