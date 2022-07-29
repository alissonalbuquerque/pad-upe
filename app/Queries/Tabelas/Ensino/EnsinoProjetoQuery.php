<?php

namespace App\Queries\Tabelas\Ensino;


use App\Models\Tabelas\Ensino\EnsinoProjeto;
use App\Queries\CustomQuery;

class EnsinoProjetoQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = EnsinoProjeto::where([]);
        
        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);
        return self::$instance;
    }

}