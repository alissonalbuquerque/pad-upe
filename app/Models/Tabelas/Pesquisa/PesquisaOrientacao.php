<?php

namespace App\Models\Tabelas\Pesquisa;

use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Models\Util\CargaHoraria;
use App\Queries\Tabelas\Pesquisa\PesquisaOrientacaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class PesquisaOrientacao extends Model
{
    use SoftDeletes;

    protected $table = 'pesquisa_orientacao';

    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'titulo_projeto', 'nome_orientando', 'funcao', 'ch_semanal'];

    protected $dates = ['deleted_at'];

    // public function orientacao()
    // {
    //     return $this->hasOne(Orientacao::class);
    // }

    public function dimensaoAsString()
    {
        return Constants::listDimensao($this->dimensao);
    }
        
    public function funcaoAsString()
    {
        return Constants::listFuncaoOrientador($this->funcao);
    }

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'titulo_projeto' => ['required', 'string', 'max:255'],
            'nome_orientando' => ['required', 'string', 'max:255'],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Constants::listFuncaoOrientador()))],
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cód. Atividade" é obrigatório!',

            //titulo_projeto
            'titulo_projeto.required' => 'O campo "Título do Projeto" é obrigatório!',

            //nome_orientando
            'nome_orientando.required' => 'O campo "Nome do Orientando" é obrigatório!',

            //funcao
            'funcao.required' => 'O campo "Função" é obrigatório!',
            'funcao.integer' => 'O campo "Função" deve cónter um inteiro!',
            'funcao.in' => 'Selecione uma opção da lista de "Função"!',
        ];
    }
    
    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['P-3'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public static function initQuery()
    {
        return new PesquisaOrientacaoQuery(get_called_class());
    }
}
