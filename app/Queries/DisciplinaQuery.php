<?php

namespace App\Queries;

use App\Models\Disciplina;
use App\Queries\Query;

class DisciplinaQuery extends Query {

    public function __construct($init = []) {
        $this->query = Disciplina::where($init);
    }

    /**
     * @param integer|string $curso_id
     * @param string $expression 
     * @return Builder
     */
    public function whereCursoId($curso_id, string $expression = '=') {
        $this->query->where('curso_id', $expression, $curso_id);
        return $this->query;
    }

}