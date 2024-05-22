<?php

namespace App\Models\Util;


class Status
{
    const ATIVO = 1;
    const INATIVO = 2;
    const PENDENTE = 3;
    const ARQUIVADO = 4;
    const FINALIZADO = 5;
    const REPROVADO = 6;
    const APROVADO = 7;
    const EM_REVISAO = 8;

    public static function listStatus($value = null)
    {

        $values = [
            self::ATIVO => 'Ativo',
            self::INATIVO => 'Inativo',
            self::PENDENTE => 'Pendente',
            self::ARQUIVADO => 'Em Avaliação',
            self::FINALIZADO => 'Finalizado',
            self::REPROVADO => 'Reprovado',
            self::APROVADO => 'Aprovado',
            self::EM_REVISAO => 'Em Revisão'
        ];

        return $value !== null ? $values[$value] : $values;
    }

    public static function listUserTypeStatus($value = null)
    {

        $values = [
            self::ATIVO => 'Ativo',
            self::INATIVO => 'Inativo',
        ];

        return $value !== null ? $values[$value] : $values;
    }
}
