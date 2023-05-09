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
        ];
    
        return $value !== null? $values[$value] : $values;
    }

    public static function getDimensaoToRoute($dimensoes){
        switch (Dimensao::listDimensao($dimensoes)) {
            case 'Ensino':
                return "ensino";
            case 'Pesquisa':
                return "pesquisa";
            case 'Extensão':
                return "extensao";
            case 'Gestão':
                return "gestao";
                break;
        }
    }
}
