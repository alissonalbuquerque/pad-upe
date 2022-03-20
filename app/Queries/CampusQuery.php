<?php

namespace App\Queries;

use App\Models\Campus;

class CampusQuery extends Campus {

    /**
     * @param integer $id
     * @param string $expression 
     * @return array|Campus|null
     */
    public static function whereUnidadeId(int $id, string $expression = '=')
    {
        return Campus::where('unidade_id', $expression, $id);
    }
        
}