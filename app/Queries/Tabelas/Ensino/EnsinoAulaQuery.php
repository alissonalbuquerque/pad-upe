<?php

namespace App\Queries\Tabelas\Ensino;

use App\Models\EnsinoAula;
use App\Queries\Query;

class EnsinoAulaQuery extends Query {

    public function __construct($init = []) {
        $this->query = EnsinoAula::where($init);
    }

    /**
     * @param integer $pad_id
     * @param string $expression 
     * @return Builder
     */
    public function wherePadId(int $pad_id, string $expression = '=') {
        $this->query->where('pad_id', $expression, $pad_id);
    }

}