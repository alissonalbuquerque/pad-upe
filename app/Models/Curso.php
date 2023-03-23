<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Curso extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * References table curso
     * 
     * @var string
     */
    protected $table = 'cursos';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['name', 'campus_id'];

    /**
     * Get Campus with campus.id = curso.campus_id
     * 
     * @return Campus
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public static function validator($attributes, $rule_password = false)
    {

        $rules = [
            'name' => ['required', 'min:8', 'max:255'],
            'campus_id' => ['required', 'integer']
        ];

        $messages = [
            //name
            'name.required' => 'O campo "Nome do Campus" é obrigatório.',
            'name.min' => 'O campo "Nome do Campus" deve ter no minímo 8 (oito) caracteres.',
            'name.max' => 'O campo "Nome do Campus" deve ter no máximo 255 (duzentos e cinquenta e cinco) caracteres.',
            
            //campus_id
            'campus_id.required' => 'O campo "Campus" é obrigatório.',
            'campus_id.integer' => 'O campo "Campus" deve ser um inteiro.',
        ];

        try {
            return Validator::make($attributes, $rules, $messages);
        } catch (ValidationException $exception) {
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
