<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anexo extends Model
{   
    use SoftDeletes;

    public const SEMESTRE_1 = 1;
    public const SEMESTRE_2 = 2;

    public const CATEGORIA_ = 1;
    // public const CATEGORIA_ = 2;
    // public const CATEGORIA_ = 3;
    // public const CATEGORIA_ = 4;
    // public const CATEGORIA_ = 5;

    protected $table = "anexo_b";

    protected $fillable = [
        'user_pad_id',
        'campus_id',
        'curso_id',
        'semestre',
        'matricula',
        'carga_horaria',
        'categoria_nivel',
        'afastamento_total',
        'afastamento_total_desc',
        'afastamento_parcial',
        'afastamento_parcial_desc',
        'direcao_sindical',
        'licenca',
    ];

    protected $dates = ['deleted_at'];


    public static function listSemestre($value = null) {
    
        $values = [
            self::SEMESTRE_1 => '1º SEMESTRE',
            self::SEMESTRE_2 => '2º SEMESTRE',
        ];
    
        return $value !== null? $values[$value] : $values;
    }

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function curso() {
        return $this->belongsTo(Curso::class);
    }

    public static function listCategoria($value = null) {
    
        $values = [
            
        ];
    
        return $value !== null? $values[$value] : $values;
    }
}
