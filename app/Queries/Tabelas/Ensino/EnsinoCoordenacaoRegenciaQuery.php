<?php

namespace App\Queries\Tabelas\Ensino;


use App\Models\Tabelas\Ensino\CoordenacaoRegencia;
use App\Queries\CustomQuery;

class CoordenacaoRegenciaQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = CoordenacaoRegencia::where([]);
        
        self::$instance = $this;
    }

    public function whereUserPad($user_pad_id, $operator = '=')
    {
        $this->query = $this->query->where('user_pad_id', $operator, $user_pad_id);
        return self::$instance;
    }

}