<?php

namespace App\Models\Tabelas\Pesquisa;

use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Queries\Tabelas\Pesquisa\PesquisaLiderancaQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class PesquisaLideranca extends Model
{
    use SoftDeletes;

    protected $table = 'pesquisa_lideranca';

    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'grupo_pesquisa', 'atividade', 'funcao', 'ch_semanal'];

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
        return Constants::listFuncaoProjeto($this->funcao);
    }

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'grupo_pesquisa' => ['required', 'string', 'max:255'],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Constants::listFuncaoProjeto()))],
            'ch_semanal' => ['required', 'integer', 'min:1'],
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cód. Atividade" é obrigatório!',
            
            //grupo_pesquisa
            'grupo_pesquisa.required' => 'O campo "Título do Projeto" é obrigatório!',

            //funcao
            'funcao.required' => 'O campo "Função" é obrigatório!',
            'funcao.integer' => 'O campo "Função" deve cónter um inteiro!',
            'funcao.in' => 'Selecione uma opção da lista de "Função"!',
            
            //ch_semanal
            'ch_semanal.required' => 'O campo "CH. Semanal" é obrigatório!',
            'ch_semanal.min' => 'Carga horária semanal miníma é de 1 Hora!',
        ];
    }
    
    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['P-1'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public static function initQuery()
    {
        return new PesquisaLiderancaQuery(get_called_class());
    }
}
