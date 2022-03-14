<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const TYPE_ADMIN = 1;       // Administrador
    const TYPE_TEACHER = 2;     // Professor
    const TYPE_MANAGER = 3;     // Diretor
    const TYPE_COORDINATOR = 4; // Coordenador

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    CONST STATUS_DELETED = 0;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'document', 'type', 'status', 'curso_id', 'unidade_id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * Get Curso with curso.id = user.curso_id
     * 
     * @return Curso|null
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    /**
     * Get Unidade with unidade.id = user.unidade_id
     * 
     * @return Unidade|null
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
