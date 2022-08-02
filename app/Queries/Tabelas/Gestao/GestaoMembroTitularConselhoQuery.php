<?php

namespace App\Queries\Tabelas\Gestao;


use App\Models\Tabelas\Gestao\GestaoMembroTitularConselho;
use App\Queries\CustomQuery;

class GestaoMembroTitularConselhoQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = GestaoMembroTitularConselho::where([]);
        
        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);
        return self::$instance;
    }

}