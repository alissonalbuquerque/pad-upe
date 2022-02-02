<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    const ARCOVERDE = 1;
    const CARUARU = 2;
    const GARANHUNS = 3;
    const NAZARE_DA_MATA = 4;
    const PALMARES = 5;
    const PETROLINA = 6;
    const RECIFE = 7;
    const REGIAO_METROPOLITANA = 8;
    const SALGUEIRO = 9;
    const SERRA_TALHADA = 10;

    /**
     * @param integer $value
     * @return array|string
     */
    public static function listUnidades($value = null)
    {
        $values = [
            self::ARCOVERDE => 'Arcoverde',
            self::CARUARU => 'Caruaru',
            self::GARANHUNS => 'Garanhuns',
            self::NAZARE_DA_MATA => 'Nazaré da Mata',
            self::PALMARES => 'Palmares',
            self::PETROLINA => 'Petrolina',
            self::RECIFE => 'Recife',
            self::REGIAO_METROPOLITANA => 'Região Metropolitana',
            self::SALGUEIRO => 'Salgueiro',
            self::SERRA_TALHADA => 'Serra Talhada',        
        ];

        return $value != null? $values[$value] : $values;
    }
}
