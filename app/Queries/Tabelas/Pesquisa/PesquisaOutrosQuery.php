<?php

namespace App\Queries\Tabelas\Pesquisa;

use App\Models\Tabelas\Pesquisa\PesquisaOutros;
use App\Queries\CustomQuery;

class PesquisaOutrosQuery extends CustomQuery
{
    public function __construct()
    {
        $this->query = PesquisaOutros::where([]);

        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);

        return self::$instance;
    }

    public function whereCodDimensao($cod_dimensao, $operator = '=')
    {   
        $this->query = $this->query->where('cod_dimensao', $operator, $cod_dimensao);

        return self::$instance;
    }

}