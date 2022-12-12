<?php

namespace App\Models\Util;


class Status
{   
    const ATIVO = 1;
    const INATIVO = 2;
    const PENDENTE = 3;
    const ARQUIVADO = 4;
    const FINALIZADO = 5;
    
    public static function listStatus($value = null) {
    
        $values = [
            self::ATIVO => 'Ativo',
            self::INATIVO => 'Inativo',
            self::PENDENTE => 'Pendente',
            self::ARQUIVADO => 'Arquivado',
            self::FINALIZADO => 'Finalizado',
        ];
    
        return $value !== null? $values[$value] : $values;
    }
}
