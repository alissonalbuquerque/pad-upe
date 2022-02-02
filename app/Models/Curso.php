<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    /**
     * References table curso
     * 
     * @var string
     */
    protected $table = 'curso';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['name', 'campus_id'];

}

