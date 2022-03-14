<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    /**
     * References table campus
     * 
     * @var string
     */
    protected $table = "campus";

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['name', 'unidade_id'];
    
    /**
     * Get Unidade with unidade.id = campus.unidade_id
     * 
     * @return Unidade
     */
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
