<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use App\Models\Util\Status;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {           
        $teachers = [1,2,3,4,5];
        foreach($teachers as $teacher) 
        {   
            UserType::create([
                'user_id' => $teacher,
                'type' => UserType::TEACHER,
                'status' => Status::INATIVO,
                'selected' => true,
            ]);
        }

        UserType::create([
            'user_id' => 6,
            'type' => UserType::ADMIN,
            'status' => Status::INATIVO,
            'selected' => true,
        ]);

        
    }
}
