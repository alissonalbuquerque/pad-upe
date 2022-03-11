<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{   

    /**
     * References table unidade
     * 
     * @var string
     */
    protected $table = "unidade";


    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['name'];
    

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
    
}
