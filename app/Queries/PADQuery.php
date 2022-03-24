<?php

namespace App\Queries;

use App\Models\PAD;

class PADQuery extends PAD {

    /**
     * @param integer $id
     * @param string $expression 
     * @return PAD|null
     */
    public static function whereUnidadeId(int $id, string $expression = '=')
    {
        return PAD::where('unidade_id', $expression, $id);
    }
        
}