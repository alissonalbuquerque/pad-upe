<?php

namespace App\Models\Tabelas\Extensao;

use App\Models\Planejamento;
use App\Queries\Tabelas\Extensao\ExtensaoOutrosQuery;
use Illuminate\Database\Eloquent\Model;

class ExtensaoOutros extends Model
{
    /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'extensao_outro';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_dimensao', 'cod_atividade', 'atividade', 'descricao', 'ch_semanal'];

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'atividade' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:255'],
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cod. Atividade" é obrigatório!',

            //atividade
            'atividade.required' => 'O campo "Atividade" é obrigatório!',

            //descricao
            'descricao.required' => 'O campo "Curso" é obrigatório!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['X-3'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    public static function initQuery()
    {
        return new ExtensaoOutrosQuery(get_called_class());
    }

}
