<?php

namespace App\Queries;

use App\Models\User;

class UserQuery {

    private $query;

    public function __construct()
    {
        $this->query = User::where([]);
    }

    /**
     * @param integer $id
     * @return UserQuery|Builder
     */
    public function whereId($id, $expression = '=')
    {
        $this->query = $this->query->where('id', $expression, $id);
        return $this->query;
    }

    /**
     * @param integer $type
     * @return UserQuery|Builder
     */
    public function whereType($type, $expression = '=')
    {
        $this->query = $this->query->where('type', $expression, $type);
        return $this->query;
    }

    /**
     * @return Builder
     */
    public function getQuery()
    {
        return $this->query;
    }
}