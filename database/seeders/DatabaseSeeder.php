<?php

namespace Database\Seeders;

use App\Models\Unidade;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UnidadeSeeder::class,
            CampusSeeder::class,
            CursoSeeder::class,
            UserSeeder::class,
            PlanejamentoSeeder::class,
            PADSeeder::class,
            DisciplinaSeeder::class,
        ]);
    }
}
