<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Util\CargaHoraria;
use App\Models\Util\Nivel;
use App\Queries\Tabelas\Ensino\EnsinoParticipacaoQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EnsinoParticipacao extends Model
{
     /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_participacao';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'curso', 'nivel', 'ch_semanal'];

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'nivel' => ['required', 'integer', Rule::in(array_keys(Nivel::listNivel()))],
            'ch_semanal' => CargaHoraria::ch_semanal()
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cod. Atividade" é obrigatório!',

            //curso
            'curso.required' => 'O campo "Curso" é obrigatório!',

            //nivel
            'nivel.required' => 'O campo "Nível" é obrigatório!',
            'nivel.in' => 'Selecione uma opção da lista de "Nível"!',
            'nivel.integer' => 'O campo "Nível" deve cónter um inteiro!',

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
        $codes = ['E-12'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    public static function initQuery()
    {
        return new EnsinoParticipacaoQuery(get_called_class());
    }

}
