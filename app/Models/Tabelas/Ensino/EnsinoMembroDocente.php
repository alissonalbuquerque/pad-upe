<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Queries\Tabelas\Ensino\EnsinoMembroDocenteQuery;
use Illuminate\Database\Eloquent\Model;

class EnsinoMembroDocente extends Model
{
        /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_membro_docente';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'nucleo', 'documento', 'funcao', 'ch_semanal'];

    public static function rules()
    {
        return [

        ];
    }

    public static function messages()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['E-13', 'E-'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    public static function initQuery()
    {
        return new EnsinoMembroDocenteQuery(get_called_class());
    }
    
}
