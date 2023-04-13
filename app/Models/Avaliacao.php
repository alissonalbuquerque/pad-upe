<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacao';

    protected $fillable = ['tarefa_id', 'avaliador_id', 'type', 'status', 'descricao', 'ch_semanal', 'hora_reajuste'];


    public function tarefa() {
        //return $this->belongsTo(Pad::class);
    }

    public function avaliadorPad() {
        return $this->belongsTo(AvaliadorPad::class);
    }
}
