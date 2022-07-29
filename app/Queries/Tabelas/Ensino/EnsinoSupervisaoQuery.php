<?php

namespace App\Queries\Tabelas\Ensino;

use App\Models\Tabelas\Ensino\EnsinoSupervisao;
use App\Queries\CustomQuery;

class EnsinoSupervisaoQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = EnsinoSupervisao::where([]);
        
        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);
        return self::$instance;
    }

}