<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Database\Seeder;

class DisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $cursos = Curso::all();
        $disciplinas = ['Disciplina A', 'Disciplina B', 'Disciplina C', 'Disciplina D', 'Disciplina E'];

        foreach($cursos as $curso) {
            foreach($disciplinas as $disciplina) {
                Disciplina::create([
                    'name' => $curso->name .' - '. $disciplina,
                    'curso_id' => $curso->id,
                ]);
            }
        }
    }
}
