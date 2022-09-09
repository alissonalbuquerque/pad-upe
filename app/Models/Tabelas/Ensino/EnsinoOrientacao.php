<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Queries\PlanejamentoQuery;
use App\Queries\Tabelas\Ensino\EnsinoOrientacaoQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnsinoOrientacao extends Model
{
    /**
     * References table ensino_orientacoes
     * 
     * @var string
     */
    protected $table = 'ensino_orientacoes';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'cod_atividade', 'atividade', 'curso_id', 'nivel', 'type_orientacao', 'numero_orientandos', 'ch_semanal', 'pad_id'];

    /**
     * @return array
     */
    public static function rules()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    public static function messages()
    {
        return [
            
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos()
    {
        $codes = ['E-5', 'E-6', 'E-7', 'E-8', 'E-9', 'E-17'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public static function initQuery()
    {
        return new EnsinoOrientacaoQuery(get_called_class());
    }

}
