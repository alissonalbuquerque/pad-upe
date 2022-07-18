<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliador_pad';

    protected $fillable = ['id', 'ch_semanal', 'status', 'descricao', 'tarefa_id', 'avaliador_id'];


    public function tarefa() {
        //return $this->belongsTo(PAD::class);
    }

    public function avaliadorPad() {
        return $this->belongsTo(AvaliadorPad::class);
    }
}
