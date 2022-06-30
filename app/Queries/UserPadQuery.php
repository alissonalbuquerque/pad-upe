<?php

namespace App\Queries;

use App\Models\UserPad;

class UserPadQuery {

    private $query;

    public function __construct()
    {
        $this->query = UserPad::where([]);
    }

    /**
     * @param integer $id
     * @return UserPadQuery|Builder
     */
    public function whereId($id, $expression = '=')
    {
        $this->query = $this->query->where('id', $expression, $id);
        return $this->query;
    }

    /**
     * @param integer $user_id
     * @return UserPadQuery|Builder
     */
    public function whereUser($user_id, $expression = '=')
    {
        $this->query = $this->query->where('user_id', $expression, $user_id);
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