<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Util\Status;
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
        $ids = [1, 2, 3, 4, 5];
        foreach($ids as $id)
        {
            User::create([
                'name' => "Professor {$id}",
                'email' => "professor{$id}@upe.br",
                'email_verified_at' => null,
                'password' => Hash::make('@professor'),
                'status' => Status::ATIVO,
                'campus_id' => 3,
                'curso_id' => 1,
            ]);
        }

        // UserAdmin
        User::create([
            'name' => "Admin",
            'email' => "admin@upe.br",
            'email_verified_at' => null,
            'password' => Hash::make('@admin'),
            'status' => Status::ATIVO,
            'campus_id' => NULL,
            'curso_id' => NULL,
        ]);

        //UserDirector
        User::create([
            'name' => "Director",
            'email' => "director@upe.br",
            'email_verified_at' => null,
            'password' => Hash::make('@director'),
            'status' => Status::ATIVO,
            'campus_id' => 1,
            'curso_id' => 1,
        ]);

        //UserDirector
        User::create([
            'name' => "Coordinator",
            'email' => "coordinator@upe.br",
            'email_verified_at' => null,
            'password' => Hash::make('@coordinator'),
            'status' => Status::ATIVO,
            'campus_id' => 1,
            'curso_id' => 1,
        ]);
    }
}
