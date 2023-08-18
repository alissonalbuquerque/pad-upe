<?php

namespace App\Models\Tabelas\Traits;

use App\Models\Avaliacao;

trait ExpandTask {

    public function avaliacao() {
        return $this->hasOne(Avaliacao::class, 'tarefa_id', 'id')->whereType(Avaliacao::getTypeByClassPath($this::class));
    }
    
}