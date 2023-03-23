<?php

namespace Database\Seeders;

use App\Models\Unidade;
use Illuminate\Database\Seeder;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unidades = [
            'ARCOVERDE',
            'CARUARU',
            'GARANHUNS',
            'NAZARÉ DA MATA',
            'PALMARES',
            'PETROLINA',
            'RECIFE',
            'SALGUEIRO',
            'SERRA TALHADA',
        ];

        foreach($unidades as $unidade)
        {   
            Unidade::create(['name' => $unidade]);
        }
    }
}
