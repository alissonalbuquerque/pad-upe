<?php

namespace App\Rules;

use App\Models\TaskTime;
use Illuminate\Contracts\Validation\Rule;

class ValidationRangeTime implements Rule
{
    /** @var string|integer */
    protected $id;

    /** @var string|integer */
    protected $user_pad_id;

    /** @var string|integer */
    protected $tarefa_id;

    /** @var string|integer */
    protected $type;

    /** @var string|integer */
    protected $weekday;

    /** @var string|date */
    protected $start_time;

    /** @var string|date */
    protected $end_time;

    /** @var TaskTime */
    protected $taskTime;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($attributes = [])
    {
        $this->id           = $attributes['id'];
        $this->user_pad_id  = $attributes['user_pad_id'];
        $this->tarefa_id    = $attributes['tarefa_id'];
        $this->type         = $attributes['type'];
        $this->weekday      = $attributes['weekday'];
        $this->start_time   = $attributes['start_time'];
        $this->end_time     = $attributes['end_time'];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $start_time = "{$this->start_time}:00";
        $end_time = "{$this->end_time}:00";

        $taskTimeQuery = 
                TaskTime::whereUserPadId($this->user_pad_id)
                        ->whereWeekday($this->weekday)
                        ->where(
                            function($query) use ($start_time, $end_time) {
                                $query->whereBetween('start_time', [$start_time, $end_time]);
                                $query->orWhereBetween('end_time', [$start_time, $end_time]);
                            }
                        );

        if(isset($this->id)) {
            $taskTimeQuery->where('id', '!=', $this->id);
        }

        $this->taskTime = $taskTimeQuery->first();

        return !$taskTimeQuery->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Não é possivel utilizar o horário, ele está sendo preenchido por \"{$this->taskTime->getCode()} : {$this->taskTime->getName()}\" !";
    }
}
