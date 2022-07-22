<?php

namespace App\Queries;

use App\Models\User;

class UserQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = User::where([]);

        self::$instance = $this;
    }

    /**
     * @param integer $id
     * @return UserQuery|Builder
     */
    public function whereId($id, $operator = '=')
    {
        $this->query = $this->query->where('id', $operator, $id);
        return self::$instance;
    }

    /**
     * @param integer $email
     * @return UserQuery|Builder
     */
    public function whereEmail($email, $operator = 'LIKE')
    {   
        $this->query = $this->query->where('email', $operator, $email);
        return self::$instance;
    }

    /**
     * @param integer $type
     * @return UserQuery|Builder
     */
    public function whereType($type, $operator = '=')
    {   
        $this->query = 
                $this->query
                        ->join('user_type', 'users.id', '=', 'user_type.user_id')
                        ->where('type', $operator, $type);

        return self::$instance;
    }
}