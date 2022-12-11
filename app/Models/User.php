<?php

namespace App\Models;

use App\Queries\UserQuery;
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

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'status', 'curso_id', 'campus_id'];

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


    // Validate User General:  name, email and password
    public static function ruleDefault()
    {
        return [
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email']
        ];
    }

    public static function validatePassword()
    {
        return [

        ];
    }

    // Validate User from Type Admin
    public static function ruleAdmin()
    {
        return [

        ];
    }

    // Validate User from Type Teacher
    public static function ruleTeacher()
    {

        return [];
    }

    public static function messages()
    {
        return [
            'name.required' => 'O campo "Nome" é obrigatório!',
            'email.required' => 'O "E-Mail" é obrigatório',
        ];
    }

    /** 
     * Validar os campos de acordo com as regras implementadas
     * 
     */
    public static function validator($attributes, $rule_password = false) {

        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email'],
        ];

        if($rule_password) {
            $rules = [
                'password' => ['required', 'min:8'],
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


    public function perfis()
    {
        return $this->hasMany(UserType::class);
    }

    /**
     * @return UserType|Null
     */
    public function perfilSelected()
    {   
        return $this->perfis()->where('selected', true)->first();
    }

    /**
     * @return bool
     */
    public function isTypeAdmin()
    {
        return $this->perfilSelected()->type === UserType::ADMIN;
    }

    /**
     * @return bool
     */
    public function isTypeTeacher()
    {
        return $this->perfilSelected()->type === UserType::TEACHER;
    }

    /**
     * @return bool
     */
    public function isTypeDirector()
    {
        return $this->perfilSelected()->type === UserType::DIRECTOR;
    }

    /**
     * @return bool
     */
    public function isTypeCoordinator()
    {
        return $this->perfilSelected()->type === UserType::COORDINATOR;
    }

    /**
     * @return bool
     */
    public function isTypeEvaluator()
    {
        return $this->perfilSelected()->type === UserType::EVALUATOR;
    }

    public static function initQuery()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
