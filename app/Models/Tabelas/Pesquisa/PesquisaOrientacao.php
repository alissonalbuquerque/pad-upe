<?php

namespace App\Models\Tabelas\Pesquisa;

use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Queries\Tabelas\Pesquisa\PesquisaOrientacaoQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesquisaOrientacao extends Model
{
    use SoftDeletes;

    protected $table = 'pesquisa_orientacao';

    protected $fillable = ['dimensao', 'user_pad_id', 'cod_atividade', 'titulo_projeto', 'nome_orientando', 'funcao', 'ch_semanal'];

    protected $dates = ['deleted_at'];

    public function dimensaoAsString()
    {
        return Constants::listDimensao($this->dimensao);
    }
        
    public function funcaoAsString()
    {
        return Constants::listFuncaoOrientador($this->funcao);
    }
    
    /**
     * @return array
     */
    public static function getPlanejamentos() {
        $codes = ['P-3'];
        return Planejamento::initQuery()->whereInCodDimensao($codes)->get();
    }

    public static function initQuery()
    {
        return new PesquisaOrientacaoQuery(get_called_class());
    }
}
