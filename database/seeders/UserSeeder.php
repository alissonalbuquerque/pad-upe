<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // UsersTeacher
        $ids = range(1, 5);
        foreach($ids as $id)
        {
            User::create([
                'type' => User::TYPE_TEACHER,
                'name' => "User {$id}",
                'email' => "user{$id}@upe.br",
                'email_verified_at' => null,
                'password' => Hash::make('12345678'),
                'document' => "00000000{$id}",
                'status' => User::STATUS_ACTIVE,
                'unidade_id' => 3,
                'curso_id' => 1,
            ]);
        }

        // UserAdmin
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => "Admin",
            'email' => "admin@upe.br",
            'email_verified_at' => null,
            'password' => Hash::make('12345678'),
            'document' => "100000000",
            'status' => User::STATUS_ACTIVE,
            'unidade_id' => NULL,
            'curso_id' => NULL,
        ]);
    }
}
