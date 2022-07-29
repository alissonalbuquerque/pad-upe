<?php

namespace App\Models\Tabelas\Gestao;

use App\Models\Planejamento;
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
            'ch_semanal' => ['required', 'integer', 'min:1', 'max:2'],
        ];
    }

    public static function messages()
    {
        return [
            'required' => 'O campo ":attribute" é obrigatório!',
            'integer' => 'O campo ":attribute" deve cónter um inteiro!',
            'ch_semanal.min' => 'Carga horária semanal miníma é de 1 Hora!',
            'ch_semanal.max' => 'Carga horária semanal máxima é de 2 Horas!',
        ];
    }

    public static function initQuery()
    {
        return new GestaoMembroComissaoQuery(get_called_class());
    }
}
