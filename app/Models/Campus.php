<?php

namespace App\Models;

use App\Queries\CampusQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Campus extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * References table campus
     * 
     * @var string
     */
    protected $table = "campus";

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['name', 'unidade_id'];
    
    /**
     * Get Unidade with unidade.id = campus.unidade_id
     * 
     * @return Unidade
     */
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    public static function validator($attributes, $rule_password = false) {

        $rules = [
            'name' => ['required', 'min:8', 'max:255'],
            'unidade_id' => ['required', 'integer', ]
        ];

        $messages = [
            //name
            'name.required' => 'O campo "Nome do Campus" é obrigatório.',
            'name.min' => 'O campo "Nome do Campus" deve ter no minímo 8 (oito) caracteres.',
            'name.max' => 'O campo "Nome do Campus" deve ter no máximo 255 (duzentos e cinquenta e cinco) caracteres.',
            
            //unidade_id
            'unidade_id.required' => 'O campo "Unidade" é obrigatório.',
            'unidade_id.integer' => 'O campo "Unidade" deve ser um inteiro.',
        ];

        try {
            //return  $request->validate()
            return Validator::make($attributes, $rules, $messages);
        } catch(ValidationException $exception) {

        }
    }

    public static function initQuery()
    {
        return new CampusQuery(get_called_class());
    }
}
