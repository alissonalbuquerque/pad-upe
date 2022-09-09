<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Queries\Tabelas\Ensino\EnsinoParticipacaoQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnsinoParticipacao extends Model
{
     /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_participacao';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'curso', 'nivel', 'ch_semanal'];

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
        $codes = ['E-12'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    public static function initQuery()
    {
        return new EnsinoParticipacaoQuery(get_called_class());
    }

}
