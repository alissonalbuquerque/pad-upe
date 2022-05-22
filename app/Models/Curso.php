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
            'name' => ['min:8', 'max:255'],
            'campus_id' => ['required']
        ];

        $messages = [
            'min' => "O campo não tem o mínimo de caracteres permitido",
            'max' => "O campo atingiu o máximo de caracteres permitido",
            'required' => "O campo precisa ser preenchido",
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
