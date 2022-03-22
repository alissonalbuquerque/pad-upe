<?php

namespace App\Queries;

use App\Models\Planejamento;

class PlanejamentoQuery extends Planejamento {

    /**
     * @param integer $cod_dimensao
     * @param string $expression 
     * @return Builder
     */
    public static function whereCodDimensao(string $cod_dimensao, string $expression = '=') {
        return Planejamento::where('cod_dimensao', $expression, $cod_dimensao);
    }

    /**
     * @param integer $dimensao
     * @param string $expression 
     * @return Builder
     */
    public static function whereDimensao(int $dimensao, string $expression = '=') {
        return Planejamento::where('dimensao', $expression, $dimensao);
    }

}