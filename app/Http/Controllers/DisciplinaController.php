<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Queries\DisciplinaQuery;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{   
    
    /**
     * @return array
     */
    public function getDisciplinaByCurso($curso_id) {
        $query = new DisciplinaQuery();
        return $query->whereCursoId($curso_id)->get();
    }
}
