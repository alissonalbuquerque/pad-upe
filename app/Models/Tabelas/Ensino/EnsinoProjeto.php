<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Queries\Tabelas\Ensino\EnsinoProjetoQuery;
use Illuminate\Database\Eloquent\Model;

class EnsinoProjeto extends Model
{
        /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_projeto';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'titulo', 'curso', 'natureza', 'funcao', 'ch_semanal'];

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
        $codes = ['E-11'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    public static function initQuery()
    {
        return new EnsinoProjetoQuery(get_called_class());
    }

}
