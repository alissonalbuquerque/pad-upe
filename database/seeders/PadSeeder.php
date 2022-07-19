<?php

namespace Database\Seeders;

use App\Models\PAD;
use App\Models\User;

use Illuminate\Database\Seeder;

class PadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        PAD::create([
            'id' => 1,
            'nome' => "2022.1",
            'data_inicio' => "2022-02-01",
            'data_fim' => "2022-06-01",
            'status' => 0
        ]);

        PAD::create([
            'id' => 2,
            'nome' => "2022.2",
            'data_inicio' => "2022-07-01",
            'data_fim' => "2022-12-01",
            'status' => 1
        ]);
    }
}
