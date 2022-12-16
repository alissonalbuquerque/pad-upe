<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Util\Status;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{   

    public const NAME = 1;
    public const EMAIL = 7;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        return new User([
            'name' => $row[self::NAME],
            'email' => $row[self::EMAIL],
            'status' => Status::ATIVO,
            'password' => Hash::make('12345678')
        ]);
    }
}
