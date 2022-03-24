<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    /**
     * References table curso
     * 
     * @var string
     */
    protected $table = 'cursos';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['name', 'campus_id'];

    /**
     * Get Campus with campus.id = curso.campus_id
     * 
     * @return Campus
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
    
}

