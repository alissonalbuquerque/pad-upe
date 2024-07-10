<?php

namespace App\Search;

use Illuminate\Database\Eloquent\Model;
use App\Models\Campus;
use App\Models\User;

class TeacherAvaliatorSearch extends Model
{
    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var integer */
    public $user_id;

    /** @var integer */
    public $campus_id;

    /** @var integer */
    public $pad_id;

    /** @var integer */
    public $pad_status;

    /** @var integer */
    public $paginate;

    /** @var array */
    public $_attributes = ['name', 'email', 'user_id', 'pad_id', 'campus_id', 'pad_status', 'paginate'];

    /** @return void */
    public function load($params = [])
    {
        foreach($this->_attributes as $_attribute)
        {
            if(isset($this->$_attribute)) {
                $this->$_attribute = $this->$_attribute;
            } else if(isset($params[$_attribute])) {
                $this->$_attribute = $params[$_attribute];
            } else {
                $this->$_attribute = null;
            }
        }
    }

    /** @return Illuminate\Database\Eloquent\Collection */
    public function search($params = [])
    {
        /** @var Illuminate\Database\Eloquent\Builder */
        $query = User::where([]);

        $query->join('user_pad', 'user_pad.user_id', '=', 'users.id')
              ->join('pad', 'user_pad.pad_id', '=', 'pad.id')
              ->select('users.id', 'users.name')
              ->orderBy('name');


        $this->load($params);

        if($this->name) {
            $name = $this->name;
            $query->where('users.name', "like", "%{$name}%");
        }

        if($this->email) {
            $email = $this->email;
            $query->where('users.email', "like", "%{$email}%");
        }

        if($this->user_id) {
            $user_id = $this->user_id;
            $query->where("users.id", '!=', "{$user_id}");
        }

        if($this->pad_id) {
            $pad_id = $this->pad_id;
            $query->where("pad.id", '=', "{$pad_id}");
        }

        if($this->campus_id) {
            $campus_id = $this->campus_id;
            $query->where("users.campus_id", '=', "{$campus_id}");
        }

        if($this->pad_status) {
            $pad_status = $this->pad_status;
            $query->whereIn("pad.status", $pad_status);
        }

        return $this->paginate ? $query->get()->paginate($this->paginate) : $query->get();
    }

    /** @return Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /** @return Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function pad() {
        return $this->belongsTo(Pad::class);
    }

    /** @return Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function campus() {
        return $this->belongsTo(Campus::class);
    }
}
