<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AvaliadorPad;
use App\Models\Util\PadTables;

class EvaluatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AvaliadorPad::create([
            'id' => 1, 
            'dimensao' => PadTables::TYPE_ENSINO,
            'user_id' => 8,
            'pad_id' => 1
            ]
        );
    }
}
