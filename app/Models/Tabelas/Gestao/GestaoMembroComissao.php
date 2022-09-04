<?php

namespace App\Models\Tabelas\Gestao;

use App\Models\Planejamento;
use App\Models\Util\CargaHoraria;
use App\Queries\Tabelas\Gestao\GestaoMembroComissaoQuery;
use Illuminate\Database\Eloquent\Model;

class GestaoMembroComissao extends Model
{   
    protected $table = 'gestao_membro_comissao';

    protected $fillable = ['user_pad_id', 'dimensao', 'cod_atividade', 'nome', 'documento', 'ch_semanal'];

    public static function getPlanejamentos()
    {   
        $codes = ['G-1'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public static function rules()
    {
        return [
            'cod_atividade' => ['required', 'string', 'max:255'],
            'nome' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255'],
            'ch_semanal' => CargaHoraria::ch_semanal(CargaHoraria::create_ch_min(2)),
        ];
    }

    public static function messages()
    {
        return [            
            //cod_atividade
            'cod_atividade.required' => 'O campo "Cód. Atividade" é obrigatório!',

            //nome
            'nome.required' => 'O campo "Nome da Comissão, Comitê ou Núcleo" é obrigatório!',

            //documento
            'documento.required' => 'O campo "Documento que o Designa" é obrigatório!',

            //ch_semanal
            'ch_semanal.required' => 'O campo "CH. Semanal" é obrigatório!',
            'ch_semanal.min' => 'Carga horária semanal miníma é de 2 Horas!',
        ];
    }

    public static function initQuery()
    {
        return new GestaoMembroComissaoQuery(get_called_class());
    }
}
