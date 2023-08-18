<?php

namespace App\Models\Tabelas\Pesquisa;

use App\Models\Planejamento;
use App\Models\UserPad;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Traits\ExpandModel;
use App\Models\Tabelas\Traits\ExpandTask;
use App\Queries\Tabelas\Pesquisa\PesquisaLiderancaQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class PesquisaLideranca extends Model
{
    use SoftDeletes;
    use ExpandModel;
    use ExpandTask;

    protected $table = 'pesquisa_lideranca';

    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'grupo_pesquisa', 'atividade', 'funcao', 'ch_semanal'];

    protected $dates = ['deleted_at'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Grupo de Pesquisa:' => 'grupo_pesquisa', 'Carga Horária:' => 'ch_semanal'];

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

    public function funcaoToString() {
        return Constants::listFuncaoProjeto($this->funcao);
    }

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'grupo_pesquisa' => ['required', 'string', 'max:255'],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Constants::listFuncaoProjeto()))],
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
        ];
    }
    
    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['P-1'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new PesquisaLiderancaQuery(get_called_class());
    }

    //retorna a atividade correspondente ao código
    public function getDescricaoAtividade(){
        return "Liderança";
    }
}
