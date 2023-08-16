<?php

namespace App\Models\Tabelas\Traits;

trait ExpandModel {

    public static function getTableName() {

        $classPath = self::class;

        $model = new $classPath();

        return $model->table;
    }

    public static function getColumnName($column) {

        $classPath = self::class;

        $model = new $classPath();

        return sprintf("%s.%s", $model->table, $column);
    }
}