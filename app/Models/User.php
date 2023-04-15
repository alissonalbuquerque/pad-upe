<?php

namespace App\Models;

use App\Models\Util\Status;
use App\Queries\UserQuery;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'status', 'curso_id', 'campus_id', 'document'];

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     * @var array<string, string>
     * @var boolean $isUpdate
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected $dates = ['deleted_at'];

    public function statusAsText() {
        return $this->status !== null ? Status::listStatus($this->status) : '-';
    }

    public static function validator(array $attributes, $id = null, $ignoreStatus = true)
    {   
        $rules = [
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'curso_id' => ['integer'],
            'campus_id' => ['integer'],
            'status' => [
                Rule::requiredIf ( function() use($ignoreStatus)
                {
                    return !$ignoreStatus;
                }),
                Rule::in([Status::ATIVO, Status::INATIVO]),
                'required_with:id',
                'integer',
            ],
        ];

        $messages = [
            //name
            'name.min' => 'O campo "Nome" dever ter no mínimo 4 caracteres.',
            'name.required' => 'O campo "Nome" é obrigatório.',

            //email
            'email.required' => 'O campo "E-Mail" é obrigatório.',
            'email.email' => 'O campo "E-Mail" deve conter um e-mail valido.',
            'email.unique' => 'O "E-Mail" informado já foi cadastrado no sistema.',

            //status
            'status.required' => 'O campo "Status" é obrigatório.',
            'status.in' => 'Selecione uma opção da lista de "Status"!',
            'status.integer' => 'O campo "Status" deve cónter um inteiro!',

            //curso_id
            'curso_id.integer' => 'O campo "Curso" deve cónter um inteiro!',

            //campus_id
            'campus_id.integer' => 'O campo "Campus" deve cónter um inteiro!',
        ];

        try {
            return Validator::make($attributes, $rules, $messages);
        } catch(ValidationException $exception) {

        }
    }

    public static function validatorPassword(array $attributes)
    {
        $rules = [
            'password' => ['required', 'min:8', 'max:255', 'confirmed'],
        ];

        $messages = [
            'password.required' => 'A "senha" é obrigatória!',
            'password.min' => 'A "senha" deve conter, no mínimo, 8 caracteres!',
            'password.max' => 'A "senha" deve conter, no máximo, 255 caracteres!',
            'password.confirmed' => 'As senhas devem ser iguais!',
        ];

        try{
            return Validator::make($attributes, $rules, $messages);
        } catch(ValidationException $exception) {

        }
    }

    /** 
    * Validar os campos de acordo com as regras implementadas
    * 
    */
    // public static function validator($attributes, $rule_password = false) {

    //     $rules = [
    //         'name' => ['required'],
    //         'email' => ['required', 'email'],
    //     ];

    //     if($rule_password) {
    //         $rules = [
    //             'password' => ['required', 'min:8'],
    //             'password_confirmation' => [],
    //         ];
    //     }

    //     $messages = [
    //         // 'unique' => "O :attribute já está registrado no sistema",
    //         'required' => "O :attribute precisa ser preenchido",
    //     ];

    //     try {
    //         return Validator::make($attributes, $rules, $messages);
    //     } catch(ValidationException $exception) {

    //     }

    // }

    /**
     * Get Curso with campus.id = user.campus_id
     * 
     * @return Campus|null
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class);
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
     * Return UserType
     *
     * @param integer $type_profile
     * @return UserType
     */
    public function profile($type_profile)
    {   
        return UserType::whereUserId($this->id)->whereType($type_profile)->first();
    }

    /** @return UserType[]|null */
    public function profiles()
    {   
        return $this->hasMany(UserType::class)->whereStatus(Status::ATIVO);
    }

    /**
     * @return UserType|Null
     */
    public function profileSelected()
    {   
        return $this->profiles()->whereSelected(true)->first();
    }

    /**
     * @return bool
     */
    public function isTypeAdmin()
    {
        return $this->profileSelected()->type === UserType::ADMIN;
    }

    /**
     * @return bool
     */
    public function isTypeTeacher()
    {
        return $this->profileSelected()->type === UserType::TEACHER;
    }

    /**
     * @return bool
     */
    public function isTypeDirector()
    {
        return $this->profileSelected()->type === UserType::DIRECTOR;
    }

    /**
     * @return bool
     */
    public function isTypeCoordinator()
    {
        return $this->profileSelected()->type === UserType::COORDINATOR;
    }

    /**
     * @return bool
     */
    public function isTypeEvaluator()
    {
        return $this->profileSelected()->type === UserType::EVALUATOR;
    }

    public static function initQuery()
    {
        return new UserQuery(get_called_class());
    }

    public function dashboardName()
    {
        $name = $this->name;
        $split = explode(' ', $name);

        $dashboardName = '';

        if(count($split) >= 2) {
            $dashboardName = array_shift($split) . ' ' . array_shift($split);
        } else {
            $dashboardName = array_shift($split);
        }

        return $dashboardName;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
