<?php

namespace App\Models;

use App\Models\Util\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AvaliadorPad;

class Pad extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'pad';

    /** @var array */
    protected $fillable = ['id', 'nome', 'data_inicio', 'data_fim', 'status'];

    /** @var array */
    protected $dates = ['deleted_at'];

    const STATUS_ATIVO = 1;
    const STATUS_INATIVO = 2;
    const STATUS_ARQUIVADO = 3;

    /**
     * @return string
     * */
    public function statusAsString() {
        return self::listStatus($this->status);
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

    /**
     * @return Illuminate\Database\Eloquent\Collection
     * @return Collection<AvaliadorPad>
     */
    public function avaliadorPads(){
        return $this->hasMany(AvaliadorPad::class, 'pad_id');
    }

    public static function listStatus($value = null) {

        $values = [
            self::STATUS_ATIVO => 'Ativo',
            self::STATUS_INATIVO => 'Inativo',
            self::STATUS_ARQUIVADO => 'Arquivado',
        ];

        return $value !== null? $values[$value] : $values;
    }
}

