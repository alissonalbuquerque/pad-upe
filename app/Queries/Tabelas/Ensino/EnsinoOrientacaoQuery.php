<?php

namespace App\Queries\Tabelas\Ensino;


use App\Models\Tabelas\Ensino\EnsinoOrientacao;
use App\Queries\CustomQuery;

class EnsinoOrientacaoQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = EnsinoOrientacao::where([]);
        
        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);
        return self::$instance;
    }

}