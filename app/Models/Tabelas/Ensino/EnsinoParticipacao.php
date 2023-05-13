<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\UserPad;
use App\Models\Util\Nivel;
use App\Queries\Tabelas\Ensino\EnsinoParticipacaoQuery;
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

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Curso:' => 'curso', 'Carga Horária:' => 'ch_semanal'];

    /** @return string|array */
    public function nivelAsString()
    {
        return Nivel::listNivel($this->nivel);
    }

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'nivel' => ['required', 'integer', Rule::in(array_keys(Nivel::listNivel()))],
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cod. Atividade" é obrigatório!',

            //curso
            'curso.required' => 'O campo "Nome do Curso" é obrigatório!',

            //nivel
            'nivel.required' => 'O campo "Nível do Curso" é obrigatório!',
            'nivel.in' => 'Selecione uma opção da lista de "Nível do Curso"!',
            'nivel.integer' => 'O campo "Nível do Curso" deve cónter um inteiro!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['E-12'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new EnsinoParticipacaoQuery(get_called_class());
    }

    //retorna a atividade correspondente ao código
    public function getDescricaoAtividade(){
        return "Participação";
    }

}
