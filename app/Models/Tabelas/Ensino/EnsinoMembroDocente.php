<?php

namespace App\Models\Tabelas\Ensino;

use App\Models\Planejamento;
use App\Models\Util\CargaHoraria;
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

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'nucleo' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255'],
            'funcao' => ['required', 'integer', Rule::in(array_keys(Funcao::listFuncaoEnsino()))],
            'ch_semanal' => CargaHoraria::ch_semanal(CargaHoraria::create_ch_min(2))
        ];
    }

    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cod. Atividade" é obrigatório!',

            //nucleo
            'nucleo.required' => 'O campo "Curso" é obrigatório!',

            //documento
            'documento.required' => 'O campo "Documento" é obrigatório!',

            //funcao
            'funcao.required' => 'O campo "Função" é obrigatório!',
            'funcao.in' => 'Selecione uma opção da lista de "Função"!',
            'funcao.integer' => 'O campo "Função" deve cónter um inteiro!',

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
        $codes = ['E-13', 'E-'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    public static function initQuery()
    {
        return new EnsinoMembroDocenteQuery(get_called_class());
    }
    
}
