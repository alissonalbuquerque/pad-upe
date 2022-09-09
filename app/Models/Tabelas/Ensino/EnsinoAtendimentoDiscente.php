<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Queries\Tabelas\Ensino\EnsinoAtendimentoDiscenteQuery;
use Illuminate\Database\Eloquent\Model;

class EnsinoAtendimentoDiscente extends Model
{
     /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_atendimento_discente';


    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'componente_curricular', 'curso', 'nivel', 'ch_semanal'];

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
        $codes = ['E-16'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    public static function initQuery()
    {
        return new EnsinoAtendimentoDiscenteQuery(get_called_class());
    }
   
}
