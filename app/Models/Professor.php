use Illuminate\Support\Facades\Hash;
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model
{
    use HasFactory;
    use SoftDeletes;

    const TYPE_PROFESSOR = 1;
    const TYPE_COORDENADOR = 2;

    protected $table = 'professor';

    protected $fillable = ['type', 'email', 'password'];

    protected $hidden = ['remember_token', 'password'];

    protected $dates = 'deleted_at';
}
