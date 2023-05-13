<?php

namespace App\Models\Tabelas\Pesquisa;

use App\Models\Planejamento;
use App\Models\UserPad;
use App\Models\Tabelas\Constants;
use App\Queries\Tabelas\Pesquisa\PesquisaCoordenacaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class PesquisaCoordenacao extends Model
{   
    use SoftDeletes;

    protected $table = 'pesquisa_coordenacao';

    protected $fillable = ['orientacao_id', 'cod_dimensao', 'user_pad_id', 'dimensao', 'cod_atividade', 'titulo_projeto', 'linha_grupo_pesquisa', 'funcao', 'ch_semanal'];

    protected $dates = ['deleted_at'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Título do Projeto:' => 'titulo_projeto', 'Linha ou Grupo Pesquisa:' => 'linha_grupo_pesquisa', 'Carga Horária:' => 'ch_semanal'];

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
        return Constants::listFuncaoProjeto($this->funcao);
    }

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'titulo_projeto' => ['required', 'string', 'max:255'],
            'linha_grupo_pesquisa' => ['required', 'string', 'max:255'],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Constants::listFuncaoProjeto()))],
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
            
            //linha_grupo_pesquisa
            'linha_grupo_pesquisa.required' => 'O campo "Linha e Grupo de Pesquisa" é obrigatório!',

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
    public static function getPlanejamentos() {
        $codes = ['P-2', 'P-4'];
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
        return new PesquisaCoordenacaoQuery(get_called_class());
    }
    
    //retorna a atividade correspondente ao código
    public function getDescricaoAtividade(){
        return "Coordenação";
    }
}
