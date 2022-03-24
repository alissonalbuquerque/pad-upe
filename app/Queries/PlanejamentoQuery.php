<?php

namespace App\Queries;

use App\Models\Planejamento;

class PlanejamentoQuery extends Query {

    public function __construct($init = []) {
        $this->query = Planejamento::where($init);
    }

    /**
     * @param integer $dimensao
     * @param string $expression 
     * @return Builder
     */
    public function whereDimensao(int $dimensao, string $expression = '=') {
        $this->query = $this->query->where('dimensao', $expression, $dimensao);
        return $this->query;
    }

    /**
     * @param integer $cod_dimensao
     * @param string $expression 
     * @return Builder
     */
    public function whereCodDimensao(string $cod_dimensao, string $expression = '=') {
        $this->query = $this->query->where('cod_dimensao', $expression, $cod_dimensao);
        return $this->query;
    }

    /**
     * @param array $codes_dimensao
     * @param string $expression 
     * @return Builder
     */
    public function whereInCodDimensao($codes_dimensao) {
        $this->query = $this->query->whereIn('cod_dimensao', $codes_dimensao);
        return $this->query;
    }

}
