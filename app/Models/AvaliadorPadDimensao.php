<?php

namespace App\Models;

use App\Models\Util\Dimensao;
use Illuminate\Database\Eloquent\Model;

class AvaliadorPadDimensao extends Model
{
    protected $table = 'avaliador_pad_dimensao';

    protected $fillable = ['id', 'avaliador_pad_id', 'dimensao'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function avaliadorPad() {
        return $this->belongsTo(AvaliadorPad::class);
    }

    public function __toString()
    {   
        return Dimensao::listDimensao($this->dimensao);
    }
}
