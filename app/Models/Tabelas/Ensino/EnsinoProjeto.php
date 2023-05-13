<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\UserPad;
use App\Models\Util\Funcao;
use App\Models\Util\Natureza;
use App\Queries\Tabelas\Ensino\EnsinoProjetoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EnsinoProjeto extends Model
{
        /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_projeto';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'titulo', 'curso', 'natureza', 'funcao', 'ch_semanal'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Título:' => 'titulo', 'Curso:' => 'curso', 'Carga Horária:' => 'ch_semanal'];

    /** @return string|array */
    public function naturezaAsString()
    {
        return Natureza::listNatureza($this->natureza);
    }

    /** @return string|array */
    public function funcaoAsString()
    {
        return Funcao::listFuncaoProjeto($this->funcao);
    }

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'titulo' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'natureza' => ['required', 'integer', Rule::in(array_keys(Natureza::listNatureza()))],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Funcao::listFuncaoProjeto()))],
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cod. Atividade" é obrigatório!',

            //titulo
            'titulo.required' => 'O campo "Título do Projeto" é obrigatório!',

            //curso
            'curso.required' => 'O campo "Curso" é obrigatório!',

            //natureza
            'natureza.required' => 'O campo "Natureza" é obrigatório!',
            'natureza.in' => 'Selecione uma opção da lista de "Natureza"!',
            'natureza.integer' => 'O campo "Natureza" deve cónter um inteiro!',

            //modalidade
            'funcao.required' => 'O campo "Função" é obrigatório!',
            'funcao.in' => 'Selecione uma opção da lista de "Função"!',
            'funcao.integer' => 'O campo "Função" deve cónter um inteiro!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['E-11'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new EnsinoProjetoQuery(get_called_class());
    }

    //retorna a atividade correspondente ao código
    public function getDescricaoAtividade(){
        return "Projeto";
    }

}
