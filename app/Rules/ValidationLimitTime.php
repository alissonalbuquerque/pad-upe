<?php

namespace App\Rules;

use App\Models\TaskTime;
use DateTime;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Collection;

class ValidationLimitTime implements Rule
{   
    /** @var string|integer */
    protected $id;

    /** @var string|integer */
    protected $user_pad_id;

    /** @var string|integer */
    protected $tarefa_id;

    /** @var string|integer */
    protected $type;

    /** @var string|date */
    protected $start_time;

    /** @var string|date */
    protected $end_time;

    /** @var string */
    protected $limit_hours;

    /** @var DateInterval */
    protected $outLineTime;
    
    /** @var mixed */
    protected $task;

    /** @var TaskTime */
    protected $taskTime;
    
    /** @var Collection */
    protected $taskTimes;

    /**
     * Create a new rule instance.
     *
     * @param array $attributes
     * @return void
     * 
     * Example
     * $attributes = ['user_pad_id' => $user_pad_id, 'tarefa_id' => $tarefa_id, 'type' => $type, 'start_time' => $start_time, 'end_time' => $end_time]
     */
    public function __construct($attributes = [])
    {   
        $this->id           = $attributes['id'];
        $this->user_pad_id  = $attributes['user_pad_id'];
        $this->tarefa_id    = $attributes['tarefa_id'];
        $this->type         = $attributes['type'];
        $this->start_time   = $attributes['start_time'];
        $this->end_time     = $attributes['end_time'];

        $this->task = TaskTime::tarefaByStatic($this->type, $this->tarefa_id);

        $this->limit_hours = TaskTime::convertFloatToHour($this->task->ch_semanal);

        $this->taskTimes = $this->getTaskTimes();

        $this->taskTime = $this->createTaskTime();
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
        $limitDateTime = new DateTime($this->limit_hours);
        $sumDateTime = TaskTime::sumIntervalTimes($this->taskTimes);

        $newDateTime = new DateTime($this->taskTime->intervalTime());

        $totalDateTime = TaskTime::sumDateTimes($sumDateTime, $newDateTime);

        $this->outLineTime = $totalDateTime->diff($limitDateTime);

        // dd([
        //     'limite' => $limitDateTime,
        //     'total' => $totalDateTime,
        //     'interval' => $this->outLineTime
        // ]);

        return $limitDateTime >= $totalDateTime;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {   
        $limitDateTime = new DateTime($this->limit_hours);

        $sumDateTime = TaskTime::sumIntervalTimes($this->taskTimes);

        $diffInterval = $sumDateTime->diff($limitDateTime);

        $dateTime = new DateTime('00:00:00');

        $dateTime->add($diffInterval);

        $diff_time = $dateTime->format('H:i');

        $taskTime = $this->createTaskTime();
        $interval_time = $taskTime->intervalTime('H:i');

        $msgError = "Carga horária disponível restante: {$diff_time} hora(s)!";
        $msgError .= $diff_time == "00:00"? " Atividade Indisponível!" : " Intervalo entre inicio e fim : {$interval_time} hora(s)!";

        return $msgError;
    }

    /**
     * @return App\Models\TaskTime[]
     */
    public function getTaskTimes()
    {
        $id = $this->id;
        
        return (
            TaskTime::where('user_pad_id', '=', $this->user_pad_id)
                    ->where('tarefa_id', '=', $this->tarefa_id)
                    ->where('type', '=', $this->type)
                    ->get()
                    ->reject(function(TaskTime $model, int $key) use ($id) {
                        return $model->id == $id;
                    })
        );
    }

    /**
     * @return App\Models\TaskTime
     */
    public function createTaskTime()
    {
        $model = new TaskTime();    
        $model->user_pad_id = $this->user_pad_id;
        $model->tarefa_id = $this->tarefa_id;
        $model->type = $this->type;
        $model->start_time = $this->start_time;
        $model->end_time = $this->end_time;

        $model->start_time = "{$model->start_time}:00";
        $model->end_time = "{$model->end_time}:00";
        
        return $model;
    }
}
