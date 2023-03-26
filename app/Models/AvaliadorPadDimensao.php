<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvaliadorPadDimensao extends Model
{

    protected $table = 'avaliador_pad_dimensao';

    protected $fillable = ['id', 'avaliador_pad_id', 'dimensao'];

    protected $dates = ['deleted_at'];

    public function avaliadorPad() {
        return $this->belongsTo(AvaliadorPad::class);
    }


}
