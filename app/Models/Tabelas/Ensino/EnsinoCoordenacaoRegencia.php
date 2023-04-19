<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Util\Modalidade;
use App\Models\Util\Nivel;
use App\Queries\Tabelas\Ensino\EnsinoCoordenacaoRegenciaQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EnsinoCoordenacaoRegencia extends Model
{
    /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_coordenacao_regencia';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'cod_dimensao', 'user_pad_id', 'dimensao', 'cod_atividade', 'componente_curricular', 'curso', 'nivel', 'modalidade', 'ch_semanal'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Componente Curricular:' => 'componente_curricular', 'Curso:' => 'curso', 'Carga Horária:' => 'ch_semanal'];

    /**
     * @return string
     */
    public function nivelAsString()
    {
        return Nivel::listNivel($this->nivel);
    }

    /**
     * @return string
     */
    public function modalidadeAsString()
    {
        return Modalidade::listModalidade($this->modalidade);
    }


    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'componente_curricular' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'nivel' => ['required', 'integer', Rule::in(array_keys(Nivel::listNivel()))],
            'modalidade' => ['required', 'integer', Rule::in(array_keys(Modalidade::listModalidade()))],
            'cod_dimensao' => ['required', 'string', Rule::in(array_keys(self::listPlanejamentos()))],
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

            //'cod_dimensao'
            'cod_dimensao.required' => 'O campo "Resolução" é obrigatório',
            'cod_dimensao.in' => 'Selecione uma opção da lista de "Resolução"',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos()
    {
        $codes = ['E-14', 'E-15'];
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

    public static function initQuery() {
        return new EnsinoCoordenacaoRegenciaQuery(get_called_class());
    }
}