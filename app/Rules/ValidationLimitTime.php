<?php

namespace App\Rules;

use App\Models\TaskTime;
use DateInterval;
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

    /** @var DateInterval */
    protected $limit_date_interval;

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

        $this->limit_date_interval = TaskTime::float_to_date_interval($this->task->ch_semanal);

        $this->limit_hours = TaskTime::convertFloatToHour($this->task->ch_semanal); // deprected

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
    // public function passes($attribute, $value)
    // {
    //     $limitDateTime = new DateTime($this->limit_hours);
    //     $sumDateTime = TaskTime::sumIntervalTimes($this->taskTimes);

    //     $newDateTime = new DateTime($this->taskTime->intervalTime());

    //     $totalDateTime = TaskTime::sumDateTimes($sumDateTime, $newDateTime);

    //     dd($totalDateTime);

    //     $this->outLineTime = $totalDateTime->diff($limitDateTime);

    //     return $limitDateTime >= $totalDateTime;
    // }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //--------------------------------------------------------------

        $date_time_start = new DateTime($this->taskTime->start_time);
        $date_time_end   = new DateTime($this->taskTime->end_time);

        /** @var DateInternal|null */
        $diff = $date_time_end->diff($date_time_start);

        [$hours, $minutes] = [$diff->h, $diff->i];

        $new_model_date_interval = new DateInterval("PT{$hours}H{$minutes}M");

        //--------------------------------------------------------------

        $limit_date_interval = $this->limit_date_interval;

        $date_interval = TaskTime::sum_interval_times($this->taskTimes);

        [$date_interval_days, $date_interval_hours, $date_interval_minutes] = [$date_interval->d, $date_interval->h, $date_interval->i];

        [$new_model_days, $new_model_hours, $new_model_minutes] = [$new_model_date_interval->d, $new_model_date_interval->h, $new_model_date_interval->i];

        $date_interval_days     = $date_interval_days    + $new_model_days;
        $date_interval_hours    = $date_interval_hours   + $new_model_hours;
        $date_interval_minutes  = $date_interval_minutes + $new_model_minutes;

        $date_interval = new DateInterval("P{$date_interval_days}DT{$date_interval_hours}H{$date_interval_minutes}M");

        //--------------------------------------------------------------

        $limit_minutes      = TaskTime::date_interval_to_minutes($limit_date_interval);
        $interval_minutes   = TaskTime::date_interval_to_minutes($date_interval);

        return $limit_minutes >= $interval_minutes;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        /** @var DateInterval */
        $limit_date_interval = $this->limit_date_interval;

        /** @var DateInterval */
        $date_interval = TaskTime::sum_interval_times($this->taskTimes);

        /** @var integer */
        $limit_minutes      = TaskTime::date_interval_to_minutes($limit_date_interval);

        /** @var integer */
        $interval_minutes   = TaskTime::date_interval_to_minutes($date_interval);

        /** @var integer */
        $diff_minutes       = $limit_minutes - $interval_minutes;

        /** @var DateInterval */
        $diff_date_interval = new DateInterval("PT{$diff_minutes}M");

        /** @var DateTime */
        $date_time = new DateTime('00:00:00');

        $date_time->add($diff_date_interval);

        $diff_time = $date_time->format('H:i');

        //--------------------------------------------------------------

        $date_time_start = new DateTime($this->taskTime->start_time);
        $date_time_end   = new DateTime($this->taskTime->end_time);

        /** @var DateInternal|null */
        $diff = $date_time_end->diff($date_time_start);

        [$hours, $minutes] = [$diff->h, $diff->i];

        $new_model_date_interval = new DateInterval("PT{$hours}H{$minutes}M");

        /** @var DateTime */
        $new_date_time = new DateTime('00:00:00');

        $new_date_time->add($new_model_date_interval);

        $interval_time = $new_date_time->format('H:i');

        //--------------------------------------------------------------

        $msg_error = $diff_time != "00:00" ? "Carga horária disponível restante: {$diff_time} hora(s)! {$interval_time} hora(s)! Informada(s)!" : "Atividade Indisponível! Limite de Horas Alcançado!";

        return $msg_error;
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
