<?php

namespace App\Queries;

use App\Models\Curso;

class CursoQuery extends Query {

    public function __construct($init = [])
    {
        $this->query = Curso::where([]);
    }

    public function whereCampusId(int $campus_id, string $expression = '=') {
        $this->query = $this->query->where('campus_id', $expression, $campus_id);
        return $this->query;
    }

}

