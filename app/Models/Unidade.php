<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Unidade extends Model
{
    use SoftDeletes;
    /**
     * References table unidade
     * 
     * @var string
     */
    protected $table = "unidade";

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }


    const ARCOVERDE = 1;
    const CARUARU = 2;
    const GARANHUNS = 3;
    const NAZARE_DA_MATA = 4;
    const PALMARES = 5;
    const PETROLINA = 6;
    const RECIFE = 7;
    const REGIAO_METROPOLITANA = 8;
    const SALGUEIRO = 9;
    const SERRA_TALHADA = 10;

    /**
     * @param integer $value
     * @return array|string
     */
    public static function listUnidades($value = null)
    {
        $values = [
            self::ARCOVERDE => 'Arcoverde',
            self::CARUARU => 'Caruaru',
            self::GARANHUNS => 'Garanhuns',
            self::NAZARE_DA_MATA => 'Nazaré da Mata',
            self::PALMARES => 'Palmares',
            self::PETROLINA => 'Petrolina',
            self::RECIFE => 'Recife',
            self::REGIAO_METROPOLITANA => 'Região Metropolitana',
            self::SALGUEIRO => 'Salgueiro',
            self::SERRA_TALHADA => 'Serra Talhada',
        ];

        return $value != null ? $values[$value] : $values;
    }

    public static function validator($attributes) {

        $rules = [
            'name' => ['required', 'min:3', 'max:255'],
        ];

        $messages = [
            'name.required' => 'O campo "Nome da Unidade" é obrigatório.',
            'name.min' => 'O campo "Nome da Unidade" deve ter no minímo 3 (três) caracteres.',
            'name.max' => 'O campo "Nome da Unidade" deve ter no máximo 255 (duzentos e cinquenta e cinco) caracteres.',
        ];

        try {
            return Validator::make($attributes, $rules, $messages);
        } catch(ValidationException $exception) {

        }
    }
}
