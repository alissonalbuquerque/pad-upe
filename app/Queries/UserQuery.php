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
    public function whereId($id, $expression = '=')
    {
        $this->query = $this->query->where('id', $expression, $id);
        return self::$instance;
    }

    /**
     * @param integer $type
     * @return UserQuery|Builder
     */
    public function whereType($type, $expression = '=')
    {
        $this->query = $this->query->where('type', $expression, $type);
        return self::$instance;
    }

}