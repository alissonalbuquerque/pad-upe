<?php

namespace App\Models\Tabelas\Extensao;

use App\Models\Planejamento;
use App\Models\UserPad;
use App\Models\Tabelas\Constants;
use App\Queries\Tabelas\Extensao\ExtensaoOrientacaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class ExtensaoOrientacao extends Model
{
        /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'extensao_orientacao';
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'titulo_projeto', 'discente', 'ch_semanal', 'cod_dimensao'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Título do Projeto:' => 'titulo_projeto', 'Discente:' => 'discente', 'Carga Horária:' => 'ch_semanal'];

    // public function orientacao()
    // {
    //     return $this->hasOne(Orientacao::class);
    // }

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'titulo_projeto' => ['required', 'string', 'max:255'],
            'discente' => ['required', 'string', 'max:255'],
            'cod_dimensao' => ['required', 'string', Rule::in(array_keys(self::listPlanejamentos()))],
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cód. Atividade" é obrigatório!',
            
            //titulo_projeto
            'titulo_projeto.required' => 'O campo "Título do Projeto" é obrigatório!',

            //discente
            'discente.required' => 'O campo "Nome do Orientando" é obrigatório!',

            //'cod_dimensao'
            'cod_dimensao.required' => 'O campo "Resolução" é obrigatório',
            'cod_dimensao.in' => 'Selecione uma opção da lista de "Resolução"',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos()
    {
        $codes = ['X-10', 'X-11', 'X-12', 'X-13', 'X-14', 'X-15'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    /**
     * @return array
     */
    public static function listPlanejamentos($cod_dimensao = null)
    {
        $planejamentos = self::getPlanejamentos();

        $values = [];
        foreach($planejamentos as $planejamento) {
            $values[$planejamento->cod_dimensao] = $planejamento->descricao;
        }

        return $cod_dimensao !== null? $values[$cod_dimensao] : $values;
    }

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new ExtensaoOrientacaoQuery(get_called_class());
    }

    //retorna a atividade correspondente ao código
    public function getDescricaoAtividade(){
        return "Orientação";
    }
}
