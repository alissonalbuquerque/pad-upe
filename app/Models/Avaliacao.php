<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacao';

    protected $fillable = ['tarefa_id', 'avaliador_id', 'type', 'status', 'descricao', 'ch_semanal'];


    public function tarefa() {
        //return $this->belongsTo(PAD::class);
    }

    public function avaliadorPad() {
        return $this->belongsTo(AvaliadorPad::class);
    }
}
