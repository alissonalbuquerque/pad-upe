<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Tabelas\Traits\ExpandModel;
use App\Models\Tabelas\Traits\ExpandTask;
use App\Models\UserPad;
use App\Models\Util\Nivel;
use App\Models\Util\Supervisao;
use App\Queries\Tabelas\Ensino\EnsinoSupervisaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EnsinoSupervisao extends Model
{   
    use ExpandModel;
    use ExpandTask;
    
    /**
     * References table ensino_orientacoes
     * 
     * @var string
     */
    protected $table = 'ensino_supervisao';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'cod_dimensao', 'user_pad_id', 'dimensao', 'cod_atividade', 'atividade', 'curso', 'nivel', 'type_supervisao', 'numero_orientandos', 'ch_semanal'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Atividade:' => 'atividade', 'Curso:' => 'curso', 'Carga Horária:' => 'ch_semanal'];

    /** @return string */
    public function nivelAsString()
    {
        return Nivel::listNivel($this->nivel);
    }

    /** @return string */
    public function supervisaoAsString()
    {
        return Supervisao::listSupervisao($this->type_supervisao);
    }

    /** @return string */
    public function nivelToString()
    {
        return Nivel::listNivel($this->nivel);
    }

    /** @return string */
    public function supervisaoToString()
    {
        return Supervisao::listSupervisao($this->type_supervisao);
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
            'type_supervisao' => ['required', 'integer', Rule::in(array_keys(Supervisao::listSupervisao()))],
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

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new EnsinoSupervisaoQuery(get_called_class());
    }

    //retorna a atividade correspondente ao código
    public function getDescricaoAtividade(){
        return "Supervisões";
    }

}
