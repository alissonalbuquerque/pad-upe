<?php

namespace App\Queries\Tabelas\Ensino;


use App\Models\Tabelas\Ensino\EnsinoOutros;
use App\Queries\CustomQuery;

class EnsinoOutrosQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = EnsinoOutros::where([]);
        
        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);
        return self::$instance;
    }

}