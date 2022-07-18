<?php

namespace App\Queries;

use App\Models\Planejamento;

class PlanejamentoQuery extends CustomQuery
{

    public function __construct()
    {
        $this->query = Planejamento::where([]);

        self::$instance = $this;
    }

    /**
     * @param integer $dimensao
     * @param string $expression 
     * @return Builder
     */
    public function whereDimensao(int $dimensao, string $expression = '=')
    {
        $this->query = $this->query->where('dimensao', $expression, $dimensao);
        return self::$instance;
    }

    /**
     * @param integer $cod_dimensao
     * @param string $expression 
     * @return Builder
     */
    public function whereCodDimensao(string $cod_dimensao, string $expression = '=')
    {
        $this->query = $this->query->where('cod_dimensao', $expression, $cod_dimensao);
        return self::$instance;
    }

    /**
     * @param array $codes_dimensao
     * @param string $expression 
     * @return Builder
     */
    public function whereInCodDimensao($codes_dimensao)
    {
        $this->query = $this->query->whereIn('cod_dimensao', $codes_dimensao);
        return self::$instance;
    }

}
