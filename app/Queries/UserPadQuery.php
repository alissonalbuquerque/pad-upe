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
    public function whereId($id, $operator = '=')
    {   
        $this->query = $this->query->where('id', $operator, $id);
        return self::$instance;
    }

    /**
     * @param integer $user_type_id
     * @return UserPadQuery|Builder
     */
    public function whereUser($user_type_id, $operator = '=')
    {   
        $this->query = $this->query->where('user_type_id', $operator, $user_type_id);
        return self::$instance;
    }

    /**
     * @param integer $pad_id
     * @return UserPadQuery|Builder
     */
    public function wherePad($pad_id, $operator = '=')
    {
        $this->query = $this->query->where('pad_id', $operator, $pad_id);
        return self::$instance;
    }

    /**
     * @param integer $status
     * @return UserPadQuery|Builder
     */
    public function whereStatus($status, $operator = '=')
    {
        $this->query = $this->query->where('status', $operator, $status);
        return self::$instance;
    }

    /**
     * @param integer $status
     * @return UserPadQuery|Builder
     */
    public function wherePadStatus($status, $operator = '=') {
        $this->query = 
            $this->query
                ->leftJoin('pad', 'user_pad.pad_id', '=', 'pad.id')
                ->where('pad.status', $operator, $status);
        
        return self::$instance;
    }

}