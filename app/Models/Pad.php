<?php

namespace App\Models;

use App\Models\Util\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pad extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pad';

    /** @var array */
    protected $fillable = ['id', 'nome', 'data_inicio', 'data_fim', 'status'];

    /** @var array */
    protected $dates = ['deleted_at'];

    /**
     * @return string
     * */
    public function statusAsString() {
        return Status::listStatus($this->status);
    }

    /**
     * @return string
     */
    public function getDateInicio() {
        return Carbon::parse($this->data_inicio)->format('d/m/Y');
    }

    /**
     * @return string
     */
    public function getDateFim() {
        return Carbon::parse($this->data_fim)->format('d/m/Y');
    }

    /**
     * @return Illuminate\Database\Eloquent\Collection
     * @return Collection<UserPad>
     */
    public function userPads() {
        return $this->hasMany(UserPad::class);
    }
}

