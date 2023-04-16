<?php

namespace App\Models;

use App\Queries\UserPadQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AvaliadorPad extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $dimensoes_multiples = [];

    protected $table = 'avaliador_pad';

    protected $fillable = ['user_id' , 'pad_id', 'status'];

    protected $dates = ['deleted_at'];

    public function avaliador() {
        return $this->belongsTo(User::class);
    }

    public function pad() {
        return $this->belongsTo(Pad::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function dimensions() {
        return $this->hasMany(AvaliadorPadDimensao::class);
    }

    public static function rules()
    {
        return [

        ];
    }

    public static function messages()
    {
        return  [

        ];
    }
}
