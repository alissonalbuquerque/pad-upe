<?php

namespace App\Queries\Tabelas\Pesquisa;

use App\Models\Tabelas\Pesquisa\PesquisaLideranca;
use App\Queries\CustomQuery;

class PesquisaLiderancaQuery extends CustomQuery
{
    public function __construct()
    {
        $this->query = PesquisaLideranca::where([]);

        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);

        return self::$instance;
    }
    
}