<?php

namespace App\Models;

use App\Queries\UserPadQuery;
use App\Models\Pad;
use App\Models\Util\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//remover tabela de user_pad

class UserPad extends Model
{
    use HasFactory;

    protected $table = 'user_pad';

    protected $fillable = ['id', 'user_id', 'pad_id', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pad() {
        return $this->belongsTo(Pad::class);
    }

    public function statusAsText() {
        return Status::listStatus($this->status);
    }

    public static function initQuery() {
        return new UserPadQuery(get_called_class());
    }
}
