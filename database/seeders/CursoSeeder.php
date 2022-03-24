<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\Curso;
use Illuminate\Database\Seeder;


class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $campi = Campus::all();
        $ids = range(1, 5);

        foreach($campi as $campus)
        {   
            foreach($ids as $id)
            {   
                Curso::create([
                    'name' => "$campus->name - Curso {$id}",
                    'campus_id' => $campus->id,
                ]);
            }
        }
    }
}
