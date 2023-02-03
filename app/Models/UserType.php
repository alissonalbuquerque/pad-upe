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
    
    public static function rules($id = null, $user_id = null, $type = null) {
        return [
            //add migration with deleted_at column
            'user_id' => ['required', 'integer'],
            'status' => ['required', 'integer', Rule::in([Status::ATIVO, Status::INATIVO])],
            // 'selected' => []
            'type' => [
                'required',
                'integer',
                Rule::in(array_keys(self::listType())),
                Rule::unique('user_type')->where(function($query) use($id, $user_id, $type)
                {   
                    return $query->where('user_id', '=', $user_id)->where('type', '=', $type);
                })->ignore($id)
            ],
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

            

            //selected
        ];
    }

    public static function listType($value = null) {
    
        $values = [
            self::ADMIN => 'Administrador',
            self::TEACHER => 'Professor',
            self::DIRECTOR => 'Diretor',
            self::COORDINATOR => 'Coordenador',
            self::EVALUATOR => 'Evaluator',
        ];
        
        return $value !== null? $values[$value] : $values;
    }
}
