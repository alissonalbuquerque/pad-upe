<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PAD extends Model
{
    use HasFactory;

    /**
     * References table PADs
     * 
     * @var string
     */
    protected $table = 'PADs';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['ano', 'semestre', 'carga_horaria', 'categoria', 'afastamento_total', 'afastamento_parcial', 'exerce_funcao_admin', 'exerce_funcao_sindical', 'licenca_de_acor_legais', 'outras_observacoes', 'professor_id', 'curso_id'];

    /**
     * Get User with user.id = user.campus_id
     * 
     * @return User
     */
    public function professor()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Curso with curso.id = curso.curso_id
     * 
     * @return Curso
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
