<?php

namespace App\Queries;

use App\Models\UserPad;

class UserPadQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = UserPad::where([]);
        self::$instance = $this;
    }

    /**
     * @param integer $id
     * @return UserPadQuery|Builder
     */
    public function whereId($id, $expression = '=')
    {   
        $this->query = $this->query->where('id', $expression, $id);
        return self::$instance;
    }

    /**
     * @param integer $user_id
     * @return UserPadQuery|Builder
     */
    public function whereUser($user_id, $expression = '=')
    {   
        $this->query = $this->query->where('user_id', $expression, $user_id);
        return self::$instance;
    }

    /**
     * @param integer $pad_id
     * @return UserPadQuery|Builder
     */
    public function wherePad($pad_id, $expression = '=')
    {
        $this->query = $this->query->where('pad_id', $expression, $pad_id);
        return self::$instance;
    }

    /**
     * @param integer $status
     * @return UserPadQuery|Builder
     */
    public function wherePadStatus($status, $expression = '=') {
        $this->query = 
            $this->query
                ->leftJoin('pad', 'user_pad.pad_id', '=', 'pad.id')
                ->where('pad.status', $expression, $status);
        
        return self::$instance;
    }

}