<?php

namespace App\Models\Tabelas\Gestao;

use App\Models\Planejamento;
use App\Models\Util\CargaHoraria;
use App\Queries\Tabelas\Gestao\GestaoMembroTitularConselhoQuery;
use Illuminate\Database\Eloquent\Model;

class GestaoMembroTitularConselho extends Model
{
        /**
     * References table ensino_aulas
     * 
     * @var string
     */
    protected $table = 'gestao_membro_titular_conselho';
    
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['orientacao_id', 'user_pad_id', 'dimensao', 'cod_atividade', 'nome', 'documento', 'ch_semanal',];

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'nome' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255'],
            'ch_semanal' => CargaHoraria::ch_semanal(),
        ];
    }

    public static function messages()
    {
        return [            
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cód. Atividade" é obrigatório!',

            //nome
            'nome.required' => 'O campo "Nome do Conselho" é obrigatório!',

            //documento
            'documento.required' => 'O campo "Documento que o Designa" é obrigatório!',

            //ch_semanal
            'ch_semanal.required' => 'O campo "CH. Semanal" é obrigatório!',
            'ch_semanal.min' => 'Carga horária semanal miníma é de 1 Hora!',
        ];
    }

    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['G-2'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }


    public static function initQuery()
    {
        return new GestaoMembroTitularConselhoQuery(get_called_class());
    }
}
