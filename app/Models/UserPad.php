<?php

namespace App\Models;

use App\Queries\UserPadQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPad extends Model
{
    use HasFactory;

    protected $table = 'user_pad';

    protected $fillable = ['user_id', 'pad_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pad() {
        return $this->belongsTo(PAD::class);
    }

    public static function initQuery() {
        return new UserPadQuery(get_called_class());
    }
}
