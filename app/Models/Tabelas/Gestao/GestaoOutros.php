<?php

namespace App\Models\Tabelas\Gestao;

use App\Models\Planejamento;
use App\Models\UserPad;
use App\Queries\Tabelas\Gestao\GestaoOutrosQuery;
use Illuminate\Database\Eloquent\Model;

class GestaoOutros extends Model
{
    /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'gestao_outro';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'atividade', 'descricao', 'ch_semanal'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['nome', 'documento', 'ch_semanal'];

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
        $codes = ['G-7'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new GestaoOutrosQuery(get_called_class());
    }

}
