<?php

namespace App\Models;

use App\Models\Pad;
use App\Models\Util\Status;
use App\Queries\UserTypeQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserType extends Model
{   
    use SoftDeletes;

    const ADMIN = 1;       // Administrador
    const TEACHER = 2;     // Professor
    const DIRECTOR= 3;     // Diretor
    const COORDINATOR = 4; // Coordenador
    const EVALUATOR = 5;   // Avaliador

    /** @var string with "create", "update" */
    public $operation = 'create';

    protected $table = 'user_type';

    protected $fillable = ['user_id', 'pad_id', 'type', 'status', 'selected'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pad()
    {
        return $this->belongsTo(Pad::class);
    }

    /**
     * @return string
     */
    public function typeAsString()
    {
        return self::listType($this->type);
    }
    
    /**
     * @return string
     */
    public function statusAsString()
    {
        return Status::listStatus($this->status);
    }

    public static function initQuery()
    {
        return new UserTypeQuery(get_called_class());
    }
    
    public static function rules($id = null, $user_id = null, $type = null, $operation = 'create')
    {   
        $typeRules = ['integer', Rule::in(array_keys(self::listType()))];

        if($operation === 'create')
        {   
            array_push($typeRules, 'required');

            array_push($typeRules,
                Rule::unique('user_type')->where(function($query) use ($user_id, $type) {
                    return $query->where('user_id', $user_id)->where('type', $type)->where('deleted_at', NULL);
                })
            );
        }

        return [
            'user_id' => ['required', 'integer'],
            'status' => ['required', 'integer', Rule::in([Status::ATIVO, Status::INATIVO])],
            'type' => $typeRules  
        ];
    }

    public static function messages() {
        return [
            //user_id

            //type
            'type.required' => 'O campo "Papel" é obrigatório!',
            'type.in' => 'Selecione uma opção da lista de "Papeis"!',
            'type.integer' => 'O campo "Papel" deve cónter um inteiro!',
            'type.unique' => 'A opção do campo "Papel" já foi cadastrada!',

            //status
            'status.required' => 'O campo "Status" é obrigatório!',
            'status.in' => 'Selecione uma opção da lista de "Status"!',
            'status.integer' => 'O campo "Status" deve cónter um inteiro!',
        ];
    }

    public static function listType($value = null) {
    
        $values = [
            self::ADMIN => 'Administrador',
            self::EVALUATOR => 'Avaliador',
            self::COORDINATOR => 'Coordenador',
            self::DIRECTOR => 'Diretor',
            self::TEACHER => 'Professor',
        ];
        
        return $value !== null? $values[$value] : $values;
    }
}
