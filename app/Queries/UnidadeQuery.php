<?php

namespace App\Queries;

use App\Models\Unidade;

class UnidadeQuery extends CustomQuery
{
    public function __construct()
    {
        $this->query = Unidade::where([]);
        
        self::$instance = $this;
    }
    
}