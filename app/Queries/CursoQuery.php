<?php

namespace App\Queries;

use App\Models\Curso;

class CursoQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = Curso::where([]);

        self::$instance = $this;
    }

    public function whereCampusId(int $campus_id, string $expression = '=')
    {
        $this->query = $this->query->where('campus_id', $expression, $campus_id);
        
        return self::$instance;
    }

}

