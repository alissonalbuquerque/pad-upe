<?php

namespace App\Models\Tabelas\Pesquisa;

use App\Models\Tabelas\Constants;
use App\Queries\Tabelas\Pesquisa\PesquisaLiderancaQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesquisaLideranca extends Model
{
    use SoftDeletes;

    protected $table = 'pesquisa_lideranca';

    protected $fillable = ['dimensao', 'user_pad_id', 'cod_atividade', 'grupo_pesquisa', 'atividade', 'funcao', 'ch_semanal'];

    protected $dates = ['deleted_at'];

    public function dimensaoAsString()
    {
        return Constants::listDimensao($this->dimensao);
    }

    public function funcaoAsString()
    {
        return Constants::listFuncaoProjeto($this->funcao);
    }
    
    public static function initQuery()
    {
        return new PesquisaLiderancaQuery(get_called_class());
    }
}
