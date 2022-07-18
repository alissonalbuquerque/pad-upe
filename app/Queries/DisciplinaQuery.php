<?php

namespace App\Queries;

use App\Models\Disciplina;
use App\Queries\Query;

class DisciplinaQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = Disciplina::where([]);

        self::$instance = $this;
    }

    /**
     * @param integer|string $curso_id
     * @param string $expression 
     * @return Builder
     */
    public function whereCursoId($curso_id, string $expression = '=')
    {
        $this->query = $this->query->where('curso_id', $expression, $curso_id);
        
        return self::$instance;
    }

}