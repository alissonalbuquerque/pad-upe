<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Util\CargaHoraria;
use App\Models\Util\Nivel;
use App\Models\Util\Supervisao;
use App\Queries\Tabelas\Ensino\EnsinoSupervisaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EnsinoSupervisao extends Model
{
        /**
     * References table ensino_orientacoes
     * 
     * @var string
     */
    protected $table = 'ensino_orientacoes';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'cod_dimensao', 'user_pad_id', 'dimensao', 'cod_atividade', 'atividade', 'curso', 'nivel', 'type_supervisao', 'numero_orientandos', 'ch_semanal'];

    /**
     * @return array
     */
    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'atividade' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'nivel' => ['required', 'integer', Rule::in(array_keys(Nivel::listNivel()))],
            'type_orientacao' => ['required', 'integer', Rule::in(array_keys(Supervisao::listSupervisao()))],
            'numero_orientandos' => ['integer'],
            'cod_dimensao' => ['required', 'string', Rule::in(array_keys(self::listPlanejamentos()))],
            'ch_semanal' => CargaHoraria::ch_semanal()
        ];
    }

    /**
     * @return array
     */
    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cod. Atividade" é obrigatório!',

            //atividade
            'atividade.required' => 'O campo "Atividade: Supervisão / Preceptoria / Tutoria" é obrigatório!',

            //curso
            'curso.required' => 'O campo "Curso" é obrigatório!',

            //nivel
            'nivel.required' => 'O campo "Nível" é obrigatório!',
            'nivel.in' => 'Selecione uma opção da lista de "Nível"!',
            'nivel.integer' => 'O campo "Nível" deve cónter um inteiro!',

            //type_supervisao
            'type_supervisao.required' => 'O campo "Supervisão" é obrigatório!',
            'type_supervisao.in' => 'Selecione uma opção da lista de "Supervisão"!',
            'type_supervisao.integer' => 'O campo "Supervisão" deve cónter um inteiro!',
            
            //'numero_orientandos'
            'numero_orientandos' => 'O campo "Número de Orientandos" deve cónter um inteiro!',

            //'cod_dimensao'
            'cod_dimensao.required' => 'O campo "Resolução" é obrigatório',
            'cod_dimensao.in' => 'Selecione uma opção da lista de "Resolução"',

            //ch_semanal
            'ch_semanal.required' => 'O campo "CH. Semanal" é obrigatório!',
            'ch_semanal.min' => 'Carga horária semanal miníma é de 1 Hora!',
            'ch_semanal.integer' => 'O campo "CH. Semanal" deve cónter um inteiro!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos()
    {
        $codes = ['E-4', 'E-10', 'E-17'];
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

    public static function initQuery()
    {
        return new EnsinoSupervisaoQuery(get_called_class());
    }

}
