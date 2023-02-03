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

    public function whereType($type, $expression = "=")
    {   
        $this->query = $this->query->where('type', $expression, $type);

        return self::$instance;
    }

    public function whereUser($user_id, $expression = "=")
    {   
        $this->query = $this->query->where('user_id', $expression, $user_id);

        return self::$instance;
    }
    
    public function whereStatus($status, $expression = "=")
    {   
        $this->query = $this->query->where('status', $expression, $status);

        return self::$instance;
    }
}
