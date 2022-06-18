<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPad extends Model
{
    use HasFactory;

    protected $table = 'user_pad';

    protected $fillable = ['user_id', 'pad_id'];

    public function user() {
        $this->belongsTo(User::class);
    }

    public function pad() {
        $this->belongsTo(PAD::class);
    }

}
