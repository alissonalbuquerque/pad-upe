<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const TYPE_ADMIN = 1;       // Administrador
    const TYPE_TEACHER = 2;     // Professor
    const TYPE_DIRECTOR= 3;     // Diretor
    const TYPE_COORDINATOR = 4; // Coordenador

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_DELETED = 0;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'document', 'type', 'status', 'curso_id', 'campus_id'];

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
     * Validar os campos de acordo com as regras implementadas
     * 
     */
    public static function validator($attributes, $rule_password = false) {

        $rules = [
            'email' => ['required', 'email', ],
            'name' => ['required', ]
        ];

        if($rule_password) {
            $rules = [
                'password' => ['required', 'min:6'],
                'password_confirmation' => [],
            ];
        }

        $messages = [
            // 'unique' => "O :attribute já está registrado no sistema",
            'required' => "O :attribute precisa ser preenchido",
        ];

        try {
            return Validator::make($attributes, $rules, $messages);
        } catch(ValidationException $exception) {

        }

    }

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
     * @return bool
     */
    public function isTypeAdmin() {
        return $this->type === self::TYPE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isTypeTeacher() {
        return $this->type === self::TYPE_TEACHER;
    }

    /**
     * @return bool
     */
    public function isTypeDirector() {
        return $this->type === self::TYPE_DIRECTOR;
    }

    /**
     * @return bool
     */
    public function isTypeCoordinator() {
        return $this->type === self::TYPE_COORDINATOR;
    }

    /**
     * @return string
     */
    public function attributeName(string $attribute) {
        return $this->getTable() . '-' . $attribute;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
