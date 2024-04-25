<?php

namespace App\Search;

use App\Models\Campus;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserSearch extends Model
{   
    /** @var User */
    public $model_base;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string|integer */
    public $campus_id;

    /** @var string|integer */
    public $curso_id;

    /** @var array */
    public $_attributes = ['name', 'email', 'campus_id', 'curso_id'];

    /** @return void */
    public function load($params = [])
    {
        foreach($this->_attributes as $_attribute) {   
            $this->$_attribute = isset($params[$_attribute]) ? $params[$_attribute] : null;
        }
    }

    /** @return Illuminate\Database\Eloquent\Collection */
    public function search($params = [])
    {   
        /** @var Illuminate\Database\Eloquent\Builder */
        $query = User::where([]);

        $this->load($params);

        if($this->name) {
            $name = $this->name;
            $query->where("name", "like", "%{$name}%");
        }

        if($this->email) {
            $email = $this->email;
            $query->where("email", "like", "%{$email}%");
        }

        if($this->campus_id) {
            $campus_id = $this->campus_id;
            $query->where("campus_id", '=', "{$campus_id}");
        }

        if($this->curso_id) {
            $curso_id = $this->curso_id;
            $query->where("curso_id", '=', "{$curso_id}");
        }

        return $query->get();
    }

    /** @return Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    /** @return Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function curso() {
        return $this->belongsTo(Curso::class);
    }
}