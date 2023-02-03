<?php

namespace App\Models\Tabelas\Extensao;

use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Queries\Tabelas\Extensao\ExtensaoCoordenacaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class ExtensaoCoordenacao extends Model
{
        /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'extensao_coordenacao';
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'titulo_projeto', 'programa_extensao', 'funcao', 'ch_semanal', 'atividade', 'cod_dimensao'];

    // public function orientacao()
    // {
    //     return $this->hasOne(Orientacao::class);
    // }

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'titulo_projeto' => ['required', 'string', 'max:255'],
            'programa_extensao' => ['required', 'string', 'max:255'],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Constants::listModalidade()))],
            'atividade' => ['string', 'nullable'],
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

            //programa_extensao
            'programa_extensao.required' => 'O campo "Programa de Extensão" é obrigatório!',

            //funcao
            'funcao.required' => 'O campo "Função" é obrigatório!',
            'funcao.in' => 'Selecione uma opção da lista de "Função"!',
            'funcao.integer' => 'O campo "Função" deve ser um inteiro!',

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
        $codes = ['X-4', 'X-5', 'X-6', 'X-7', 'X-8', 'X-9'];
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

    /**
     * @return string
     */
    public function funcaoAsString()
    {
        return Constants::listFuncaoProjeto($this->funcao);
    }


    public static function initQuery()
    {
        return new ExtensaoCoordenacaoQuery(get_called_class());
    }

}
