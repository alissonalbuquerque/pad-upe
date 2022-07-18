<?php

namespace App\Models\Tabelas\Pesquisa;

use App\Models\Tabelas\Constants;
use App\Queries\Tabelas\Pesquisa\PesquisaCoordenacaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesquisaCoordenacao extends Model
{   
    use SoftDeletes;

    protected $table = 'pesquisa_coordenacao';

    protected $fillable = ['dimensao', 'user_pad_id', 'cod_atividade', 'titulo_projeto', 'linha_grupo_pesquisa', 'funcao', 'ch_semanal'];

    protected $dates = ['deleted_at'];

    public static function initQuery()
    {
        return new PesquisaCoordenacaoQuery(get_called_class());
    }

    public function dimensaoAsString()
    {
        return Constants::listDimensao($this->dimensao);
    }
    
    public function funcaoAsString()
    {
        return Constants::listFuncaoProjeto($this->funcao);
    }

    public static function rules()
    {
        return [

        ];
    }

    public static function messages()
    {
        return [

        ];
    }
    
}
