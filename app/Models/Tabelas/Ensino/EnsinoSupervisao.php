<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Queries\Tabelas\Ensino\EnsinoSupervisaoQuery;
use Illuminate\Database\Eloquent\Model;

class EnsinoSupervisao extends Model
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
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'atividade', 'curso', 'nivel', 'type_supervisao', 'numero_orientandos', 'ch_semanal'];

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
        $codes = ['E-4', 'E-10'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public static function initQuery()
    {
        return new EnsinoSupervisaoQuery(get_called_class());
    }

}
