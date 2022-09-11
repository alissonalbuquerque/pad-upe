<?php

namespace App\Queries;

class CustomQuery
{
    /** @var CustomQuery */
    protected static $instance;

    /** @var  Builder */
    public $query;

    /**
     * return sql from Builder
     * @return string
     */
    public function rawSql()
    {
        return $this->query->toSql();
    }

    public function select($statement)
    {
        return $this->query->select($statement);
    }

    public function orderBy(string $column, string $direction = 'asc')
    {   
        return $this->query->orderBy($column, $direction);
    }

    public function get()
    {
        return $this->query->get();
    }

    public function first()
    {
        return $this->query->first();
    }

    public function sum(string $column)
    {
        return $this->query->sum($column);
    }
}

