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
        $ids = [1, 2, 3, 4, 5];
        foreach($ids as $id)
        {
            User::create([
                'type' => User::TYPE_TEACHER,
                'name' => "Professor {$id}",
                'email' => "professor{$id}@upe.br",
                'email_verified_at' => null,
                'password' => Hash::make('@professor'),
                'document' => "00000000{$id}",
                'status' => User::STATUS_ACTIVE,
                'campus_id' => 3,
                'curso_id' => 1,
            ]);
        }

        // UserAdmin
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => "Admin",
            'email' => "admin@upe.br",
            'email_verified_at' => null,
            'password' => Hash::make('@admin'),
            'document' => "100000000",
            'status' => User::STATUS_ACTIVE,
            'campus_id' => NULL,
            'curso_id' => NULL,
        ]);

        //UserDirector
        User::create([
            'type' => User::TYPE_DIRECTOR,
            'name' => "Director",
            'email' => "director@upe.br",
            'email_verified_at' => null,
            'password' => Hash::make('@director'),
            'document' => "100000000",
            'status' => User::STATUS_ACTIVE,
            'campus_id' => 1,
            'curso_id' => 1,
        ]);

        //UserDirector
        User::create([
            'type' => User::TYPE_COORDINATOR,
            'name' => "Coordinator",
            'email' => "coordinator@upe.br",
            'email_verified_at' => null,
            'password' => Hash::make('@coordinator'),
            'document' => "100000000",
            'status' => User::STATUS_ACTIVE,
            'campus_id' => 1,
            'curso_id' => 1,
        ]);
    }
}
