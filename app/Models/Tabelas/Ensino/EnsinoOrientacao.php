<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Util\Nivel;
use App\Models\Util\Orientacao;
use App\Queries\Tabelas\Ensino\EnsinoOrientacaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EnsinoOrientacao extends Model
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
    protected $fillable = ['orientacao_id', 'cod_dimensao', 'user_pad_id', 'dimensao', 'cod_atividade', 'atividade', 'curso', 'nivel', 'type_orientacao', 'numero_orientandos', 'ch_semanal', 'pad_id'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Atividade:' => 'atividade', 'Curso:' => 'curso', 'Carga Horária:' => 'ch_semanal'];

    /** @return string */
    public function nivelAsString()
    {
        return Nivel::listNivel($this->nivel);
    }

    /** @return string */
    public function orientacaoAsString()
    {
        return Orientacao::listOrientacao($this->type_orientacao);
    }

    /** @return string */
    public function chSemanal()
    {
        return sprintf('%s (x%s)', $this->ch_semanal, $this->numero_orientandos);
    }

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
            'type_orientacao' => ['required', 'integer', Rule::in(array_keys(Orientacao::listOrientacao()))],
            'numero_orientandos' => ['required', 'integer', 'min:1'],
            'cod_dimensao' => ['required', 'string', Rule::in(array_keys(self::listPlanejamentos()))],
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
            'atividade.required' => 'O campo "Atividade: Orientação e/ou Coorientação" é obrigatório!',

            //curso
            'curso.required' => 'O campo "Curso" é obrigatório!',

            //nivel
            'nivel.required' => 'O campo "Nível" é obrigatório!',
            'nivel.in' => 'Selecione uma opção da lista de "Nível"!',
            'nivel.integer' => 'O campo "Nível" deve cónter um inteiro!',

            //type_orientacao
            'type_orientacao.required' => 'O campo "Orientação" é obrigatório!',
            'type_orientacao.in' => 'Selecione uma opção da lista de "Orientação"!',
            'type_orientacao.integer' => 'O campo "Orientação" deve cónter um inteiro!',
            
            //'numero_orientandos'
            'numero_orientandos.required' => 'O campo "Qtd. Participantes" é obrigatório!',
            'numero_orientandos.integer' => 'O campo "Qtd. Participantes" deve cónter um inteiro!',
            'numero_orientandos.min' => 'O valor minímo de "Qtd. Participantes" é 1 (um) participante',

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
        $codes = ['E-5', 'E-6', 'E-7', 'E-8', 'E-9'];
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

    public static function initQuery()
    {
        return new EnsinoOrientacaoQuery(get_called_class());
    }

}
