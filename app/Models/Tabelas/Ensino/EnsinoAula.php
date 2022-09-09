<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Util\CargaHoraria;
use App\Models\Util\Modalidade;
use App\Models\Util\Nivel;
use App\Queries\Tabelas\Ensino\EnsinoAulaQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EnsinoAula extends Model
{
    /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_aulas';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'componente_curricular', 'curso', 'nivel', 'modalidade', 'ch_semanal', 'ch_total'];

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'componente_curricular' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'nivel' => ['required', 'integer', Rule::in(array_keys(Nivel::listNivel()))],
            'modalidade' => ['required', 'integer', Rule::in(array_keys(Modalidade::listModalidade()))],
            'ch_semanal' => CargaHoraria::ch_semanal()
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cod. Atividade" é obrigatório!',

            //componente_curricular
            'componente_curricular.required' => 'O campo "Componente Curricular" é obrigatório!',

            //curso
            'curso.required' => 'O campo "Curso" é obrigatório!',

            //nivel
            'nivel.required' => 'O campo "Nível" é obrigatório!',
            'nivel.in' => 'Selecione uma opção da lista de "Nível"!',
            'nivel.integer' => 'O campo "Nível" deve cónter um inteiro!',

            //modalidade
            'modalidade.required' => 'O campo "Modalidade" é obrigatório!',
            'modalidade.in' => 'Selecione uma opção da lista de "Modalidade"!',
            'modalidade.integer' => 'O campo "Modalidade" deve cónter um inteiro!',

            //ch_semanal
            'ch_semanal.required' => 'O campo "CH. Semanal" é obrigatório!',
            'ch_semanal.min' => 'Carga horária semanal miníma é de 1 Hora!',
            'ch_semanal.integer' => 'O campo "CH. Semanal" deve cónter um inteiro!',
        ];
    }

    public function nivelAsString()
    {
        return Nivel::listNivel($this->nivel);
    }

    public function modalidadeAsString()
    {
        return Modalidade::listModalidade($this->modalidade);
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['E-1', 'E-2', 'E-3'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    public static function initQuery()
    {
        return new EnsinoAulaQuery(get_called_class());
    }

}
