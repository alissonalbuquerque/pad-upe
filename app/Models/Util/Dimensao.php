<?php

namespace App\Models\Util;


class Dimensao
{
    const ENSINO = 1;
    const PESQUISA = 2;
    const EXTENSAO = 3;
    const GESTAO = 4;
    const ANEXO = 5; 

    public static function listDimensao($value = null) {
    
        $values = [
            self::ENSINO => 'Ensino',
            self::PESQUISA => 'Pesquisa',
            self::EXTENSAO => 'Extensão',
            self::GESTAO => 'Gestão',
            self::ANEXO => 'Anexo',
        ];
    
        return $value !== null? $values[$value] : $values;
    }
}
