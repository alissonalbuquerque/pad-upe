<?php

namespace App\Queries;

use App\Models\Campus;

class CampusQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = Campus::where([]);
        
        self::$instance = $this;
    }

    /**
     * @param integer $id
     * @param string $expression 
     * @return array|Campus|null
     */
    public function whereUnidadeId(int $id, string $expression = '=')
    {
        $this->query = $this->query->where('unidade_id', $expression, $id);
        return self::$instance;
    }
        
}