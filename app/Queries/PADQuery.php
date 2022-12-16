<?php

namespace App\Queries;

use App\Models\Pad;

class PadQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = Pad::where([]);

        self::$instance = $this;
    }

    /**
     * @param integer $id
     * @param string $expression 
     * @return Pad|null
     */
    public function whereUnidadeId(int $id, string $expression = '=')
    {
        $this->query = $this->query->where('unidade_id', $expression, $id);

        return self::$instance;
    }
        
}