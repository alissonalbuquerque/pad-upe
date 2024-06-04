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

    const STATUS_ATIVO = 1;
    const STATUS_INATIVO = 2;
    const STATUS_ARQUIVADO = 3;
    const STATUS_EM_AVALIACAO = 4;

    const STATUS_PENDENTE = 3;
    const ARQUIVADO = 4;
    const FINALIZADO = 5;
    const REPROVADO = 6;
    const APROVADO = 7;
    const EM_REVISAO = 8;

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
        return self::list_status($this->status);
    }

    /**
     * @return string|array
     */
    public static function list_status($value = null)
    {
        $values = [
            self::STATUS_ATIVO          => 'ATIVO',
            self::STATUS_INATIVO        => 'INATIVO',
            self::STATUS_ARQUIVADO      => 'ARQUIVADO',
            self::STATUS_EM_AVALIACAO   => 'EM AVALIAÇÃO',
        ];

        return $value !== null ? $values[$value] : $values;
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
     * @return Collection<UserPad>
     */
    public function user_pads() {
        return $this->userPads();
    }

    /**
     * @return Illuminate\Database\Eloquent\Collection
     * @return Collection<AvaliadorPad>
     */
    public function avaliadorPads(){
        return $this->hasMany(AvaliadorPad::class, 'pad_id');
    }
}

