<?php

namespace App\Queries\Tabelas\Ensino;


use App\Models\Tabelas\Ensino\EnsinoParticipacao;
use App\Queries\CustomQuery;

class EnsinoParticipacaoQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = EnsinoParticipacao::where([]);
        
        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);
        return self::$instance;
    }

}