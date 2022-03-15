<?php

namespace Database\Seeders;

use App\Models\Unidade;
use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unidades = ['Arcoverde', 'Caruaru', 'Garanhuns', 'Nazaré da Mata', 'Palmares', 'Petrolina', 'Recife', 'Região Metropolitana', 'Salgueiro', 'Serra Talhada', ];
        foreach($unidades as $unidade)
        {
            Unidade::create(['name' => $unidade]);
        }
    }
}
