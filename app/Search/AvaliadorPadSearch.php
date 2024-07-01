<?php

namespace App\Search;

use App\Models\AvaliadorPad;
use App\Models\Pad;
use App\Models\User;
use App\Models\UserPad;
use Illuminate\Database\Eloquent\Model;

class AvaliadorPadSearch extends Model
{
    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var integer */
    public $user_id;

    /** @var integer */
    public $pad_id;

    /** @var integer */
    public $paginate_enable = true;

    /** @var integer */
    public $paginate_attributes = ['per_page' => 10, 'columns' => ['*'], 'page_name' => 'page'];

    /** @var integer|array|string  */
    public $paginate_per_page, $paginate_columns, $paginate_page_name;

    /** @var array */
    public $_attributes = ['name', 'email', 'user_id', 'pad_id', 'paginate'];

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

        /* @var integer */
        $this->paginate_per_page    = $this->paginate_attributes['per_page'];

        /* @var array */
        $this->paginate_columns     = $this->paginate_attributes['columns'];

        /* @var string */
        $this->paginate_page_name   = $this->paginate_attributes['page_name'];
    }

    /** @return Illuminate\Database\Eloquent\Collection */
    public function search($params = [])
    {
        /** @var Illuminate\Database\Eloquent\Builder */
        $query = AvaliadorPad::where([]);

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
            $query->where("user_id", '=', "{$user_id}");
        }

        if($this->pad_id) {
            $pad_id = $this->pad_id;
            $query->where("pad_id", '=', "{$pad_id}");
        }

        $query->join('users', 'users.id', '=', 'avaliador_pad.user_id')->whereNull('users.deleted_at')->orderBy('users.name', 'asc');

        return $this->paginate_enable ? $query->paginate($this->paginate_per_page, $this->paginate_columns, $this->paginate_page_name) : $query->get();
    }

    /** @return Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /** @return Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function pad() {
        return $this->belongsTo(Pad::class);
    }
}
