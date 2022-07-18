<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\Unidade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $unidades = Unidade::all();
        $campus_ids = range(1, 5);
        
        foreach($unidades as $unidade)
        {   
            foreach($campus_ids as $campus_id)
            {   
                Campus::create([
                    'name' => "{$unidade->name} - Campus {$campus_id}",
                    'unidade_id' => $unidade->id,
                ]);
            }
        }
    }
}
