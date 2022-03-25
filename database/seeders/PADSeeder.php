<?php

namespace Database\Seeders;

use App\Models\PAD;
use App\Models\User;
use Illuminate\Database\Seeder;

class PADSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('type', '=', User::TYPE_TEACHER)->get();
        foreach($users as $user) {
            PAD::create([
                'user_id' => $user->id,
            ]);
        }
        
    }
}
