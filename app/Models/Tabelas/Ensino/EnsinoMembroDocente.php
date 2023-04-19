<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Util\Funcao;
use App\Queries\Tabelas\Ensino\EnsinoMembroDocenteQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class EnsinoMembroDocente extends Model
{
        /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'ensino_membro_docente';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'nucleo', 'documento', 'funcao', 'ch_semanal'];

    // Array de strings para preenchimento de campos de avaliação
    public $avaliable_attributes = ['Núcleo:' => 'nucleo', 'Documento:' => 'documento', 'Carga Horária:' => 'ch_semanal'];

    public function funcaoAsString()
    {
        return Funcao::listFuncaoEnsino($this->funcao);
    }
    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'nucleo' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255'],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Funcao::listFuncaoEnsino()))],
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cod. Atividade" é obrigatório!',

            //nucleo
            'nucleo.required' => 'O campo "Núcleo" é obrigatório!',

            //documento
            'documento.required' => 'O campo "Documento" é obrigatório!',

            //funcao
            'funcao.required' => 'O campo "Função" é obrigatório!',
            'funcao.in' => 'Selecione uma opção da lista de "Função"!',
            'funcao.integer' => 'O campo "Função" deve cónter um inteiro!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['E-13', 'E-'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public function userPad() {
        return $this->belongsTo(UserPad::class);
    }

    public static function initQuery()
    {
        return new EnsinoMembroDocenteQuery(get_called_class());
    }
    
}
