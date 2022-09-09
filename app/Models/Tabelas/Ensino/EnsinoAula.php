<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Models\Util\Modalidade;
use App\Models\Util\Nivel;
use App\Queries\PlanejamentoQuery;
use App\Queries\Tabelas\Ensino\EnsinoAulaQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
            'nivel' => ['required', 'integer', Rule::in(array_keys(Constants::listNivel()))],
            'modalidade' => ['required', 'integer', Rule::in(array_keys(Constants::listModalidade()))],
            'ch_semanal' => ['required', 'integer', 'min:1'],
            'ch_total' => ['required', 'integer', 'min:1'],
        ];
    }

    public static function messages()
    {
        return [
            'required' => 'O campo ":attribute" é obrigatório!',
            'integer' => 'O campo ":attribute" deve cónter um inteiro!',
            'in' => 'Selecione uma opção da lista de ":attribute"!',
            'ch_semanal.min' => 'Carga horária semanal miníma é de 1 Hora!',
            'ch_total.min' => 'Carga horária total miníma é de 1 Hora!',
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
