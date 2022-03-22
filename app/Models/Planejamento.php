<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planejamento extends Model
{
    use HasFactory;

    const ENSINO = 1;
    const PESQUISA = 2;
    const EXTENSAO = 3;
    const GESTAO = 4;

    /**
     * @return string
     */
    public function listDimensao(int $value) {
        $values = [
            self::ENSINO => 'Ensino',
            self::PESQUISA => 'Pesquisa',
            self::EXTENSAO => 'Extensão',
            self::GESTAO => 'Gestão',
        ];
        
        return $value !== null? $values[$value] : $values;
    }

    /**
     * References table planejamentos
     * 
     * @var string
     */
    protected $table = "planejamentos";

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['cod_dimensao', 'dimensao', 'descricao', 'ch_semanal, ch_maxima'];

    /**
     * @return string
     */
    public function dimensaoAsText() {
        return $this->listDimensao($this->dimensao);
    }

}
