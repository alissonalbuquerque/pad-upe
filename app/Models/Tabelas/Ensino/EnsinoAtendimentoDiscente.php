<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Util\CargaHoraria;
use App\Models\Util\Nivel;
use App\Queries\Tabelas\Ensino\EnsinoAtendimentoDiscenteQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EnsinoAtendimentoDiscente extends Model
{
     /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_atendimento_discente';


    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'componente_curricular', 'curso', 'nivel', 'ch_semanal'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Componente Curricular:' => 'componente_curricular', 'Curso:' => 'curso', 'Carga Horária:' => 'ch_semanal'];

    public function nivelAsString()
    {
        return Nivel::listNivel($this->nivel);
    }
    
    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'componente_curricular' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'nivel' => ['required', 'integer', Rule::in(array_keys(Nivel::listNivel()))],
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
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['E-16'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new EnsinoAtendimentoDiscenteQuery(get_called_class());
    }
   
}
