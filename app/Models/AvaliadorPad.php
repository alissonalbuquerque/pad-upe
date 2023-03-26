<?php

namespace App\Models;

use App\Queries\UserPadQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliadorPad extends Model
{
    use HasFactory;

    protected $table = 'avaliador_pad';

    protected $fillable = ['id', 'dimensao', 'user_id', 'pad_id'];

    public function Avaliador() {
        return $this->belongsTo(User::class);
    }

    public function pad() {
        return $this->belongsTo(PAD::class);
    }

    public static function find() {
        return new UserPadQuery(get_called_class());
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function dimensions() {
        return $this->hasMany(Dimension::class);
    }

}
