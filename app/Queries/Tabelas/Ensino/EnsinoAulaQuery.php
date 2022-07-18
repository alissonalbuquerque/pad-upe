<?php

namespace App\Queries\Tabelas\Ensino;


use App\Models\Tabelas\Ensino\EnsinoAula;
use App\Queries\CustomQuery;

class EnsinoAulaQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = EnsinoAula::where([]);
        
        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);
        return self::$instance;
    }

}