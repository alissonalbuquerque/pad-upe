<?php

namespace App\Queries\Tabelas\Extensao;


use App\Models\Tabelas\Extensao\ExtensaoOrientacao;
use App\Queries\CustomQuery;

class ExtensaoOrientacaoQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = ExtensaoOrientacao::where([]);
        
        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);
        return self::$instance;
    }

}