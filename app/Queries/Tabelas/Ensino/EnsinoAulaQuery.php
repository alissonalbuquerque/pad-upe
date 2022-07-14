<?php

namespace App\Queries\Tabelas\Ensino;

use App\Models\EnsinoAula;
use App\Models\Tabelas\Ensino\EnsinoAula as EnsinoEnsinoAula;
use App\Queries\CustomQuery;
use App\Queries\Query;

class EnsinoAulaQuery extends CustomQuery {

    public function __construct()
    {
        $this->query = EnsinoEnsinoAula::where([]);
        
        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);
        return self::$instance;
    }

}