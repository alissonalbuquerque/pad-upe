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

    protected $table = 'pad';

    protected $fillable = ['id', 'nome', 'data_inicio', 'data_fim', 'status'];

    protected $dates = ['deleted_at'];

    public function statusAsString() {
        return Status::listStatus($this->status);
    }

    public function getDateInicio() {
        return Carbon::parse($this->data_inicio)->format('d/m/Y');
    }

    public function getDateFim() {
        return Carbon::parse($this->data_fim)->format('d/m/Y');
    }
}

