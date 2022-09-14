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
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'titulo_projeto', 'programa_extensao', 'funcao', 'ch_semanal', 'atividade'];

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
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['X-1'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
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
