<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Util\CargaHoraria;
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

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'titulo' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'natureza' => ['required', 'integer', Rule::in(array_keys(Natureza::listNatureza()))],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Funcao::listFuncaoProjeto()))],
            'ch_semanal' => CargaHoraria::ch_semanal()
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cod. Atividade" é obrigatório!',

            //titulo
            'titulo.required' => 'O campo "Componente Curricular" é obrigatório!',

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

            //ch_semanal
            'ch_semanal.required' => 'O campo "CH. Semanal" é obrigatório!',
            'ch_semanal.min' => 'Carga horária semanal miníma é de 1 Hora!',
            'ch_semanal.integer' => 'O campo "CH. Semanal" deve cónter um inteiro!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['E-11'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    public static function initQuery()
    {
        return new EnsinoProjetoQuery(get_called_class());
    }

}
