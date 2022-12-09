<?php

namespace App\Models;

use App\Models\Pad;
use App\Models\Util\Status;
use App\Queries\UserTypeQuery;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    const ADMIN = 1;       // Administrador
    const TEACHER = 2;     // Professor
    const DIRECTOR= 3;     // Diretor
    const COORDINATOR = 4; // Coordenador
    const EVALUATOR = 5;   // Avaliador

    protected $table = 'user_type';

    protected $fillable = ['user_id', 'pad_id', 'type', 'status', 'selected'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pad()
    {
        return $this->belongsTo(Pad::class);
    }

    public function typeAsString()
    {
        return self::listType($this->type);
    }
    
    public function statusAsString()
    {
        return Status::listStatus($this->status);
    }

    public function initQuery()
    {
        return new UserTypeQuery(get_called_class());
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
