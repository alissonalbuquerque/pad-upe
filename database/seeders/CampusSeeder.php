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
        $campus = [
            'ARCOVERDE' => ['ARCOVERDE'],
            'CARUARU' => ['CARUARU'],
            'GARANHUNS' => ['GARANHUNS'],
            'NAZARÉ DA MATA' => ['MATA NORTE'],
            'PALMARES' => ['MATA SUL'],
            'PETROLINA' => ['PETROLINA'],
            'RECIFE' =>  ['EAD', 'BENFICA (POLI)', 'SANTO AMARO'],
            'SALGUEIRO' => ['SALGUEIRO'],
            'SERRA TALHADA' => ['SERRA TALHADA']
        ];

        foreach($campus as $name => $array)
        {   
            $unidade = Unidade::whereName($name)->first();
            foreach($array as $item)
            {
                Campus::create([
                    'name' => $item,
                    'unidade_id' => $unidade->id
                ]);
            }
        }
    }
}