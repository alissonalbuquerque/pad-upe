<?php

namespace App\Queries;

use App\Models\UserType;

class UserTypeQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = UserType::where([]);

        self::$instance = $this;
    }
    
}
