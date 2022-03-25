<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    /**
     * References table disciplinas
     * 
     * @var string
     */
    protected $table = 'disciplinas';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['name', 'curso_id'];

    /**
     * Get Curso with curso.id = disciplinas.curso_id
     * 
     * @return Curso
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
    
}
