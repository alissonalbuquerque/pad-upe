<?php

namespace App\Queries\Tabelas;

class TablesGenericGrouped
{
    /** @var string */
    public $class;

    /** @var string */
    public $user_pad_id;

    /** @var string */
    public $cod_dimensao;

    public function __construct($class, $user_pad_id, $cod_dimensao = null)
    {
        $this->class = $class;
        $this->user_pad_id = $user_pad_id;
        $this->cod_dimensao = $cod_dimensao;
    }

    public function agroup()
    {   
        $query = $this->class::initQuery();

        if($this->user_pad_id)
        {
            $query->whereUserPad($this->user_pad_id);
        }

        if($this->cod_dimensao)
        {
            $query->whereCodDimensao($this->cod_dimensao);
        }

        return $query;
    }
}