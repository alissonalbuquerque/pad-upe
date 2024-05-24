<div class="container">

    @php
        use App\Models\TaskTime;

        $calendar = [];

        $weekColumns = [];

        $COLUMN_NAN = 'NaN';

        $max_len_column = 0;
        foreach (array_keys(TaskTime::listWeekDays()) as $weekday) {

            $weekColumn = TaskTime::whereUserPadId($user_pad->id)->whereWeekday($weekday)->orderBy('start_time', 'ASC')->get();

//            $weekColumn =
//                $weekColumn->filter(function(TaskTIme $model) {
//                    return $model->tarefa !== null;
//                });

            $weekColumns[$weekday] = $weekColumn->isNotEmpty() ? $weekColumn : collect(['--']);

            if(count($weekColumns[$weekday]) > $max_len_column) {
                $max_len_column = count($weekColumns[$weekday]);
            }
        }

        foreach (range(0, $max_len_column-1) as $i) {
            $row = [];
            foreach (array_keys(TaskTime::listWeekDays()) as $weekday) {
                isset($weekColumns[$weekday][$i]) ? array_push($row, $weekColumns[$weekday][$i]) : array_push($row, $COLUMN_NAN);
            }
            $calendar[] = $row;
        }
    @endphp

    <div class="my-4">
        <table class="table table-hover table-borderless">
            <thead>
                <tr>
                    @foreach(TaskTime::listWeekDays() as $key => $weekday)
                        <th scope="col" class="text-center">{{$weekday}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($calendar as $row)
                    <tr>
                    @foreach ($row as $model)

                        @if($model !== null)
                            <td>
                                @if($model instanceof TaskTime)
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="text-center"> <i class="bi bi-clock"></i> {{ $model->formatStartTime() }} </p>
                                        </div>
                                        <div class="card-body">
                                            @if($model->has_tarefa())
                                                <div class="text-center">

                                                    <p class="text-center"> {{ "{$model->getCode()} : {$model->getName()}" }} </p>
                                                    
                                                    <p class="text-center"> </i> DIA: {{ $model->getWeekdayAsText() }} </p>
                                                    
                                                </div>
                                            @endif
                                            @if(!$model->has_tarefa())

                                                <div class="text-center">

                                                    {{ "ATIVIDADE APAGADA !" }}

                                                    {{--  --}}
                                                    <p class="text-center"> </i> DIA: {{ $model->getWeekdayAsText() }} </p>
                                                    {{--  --}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-header">
                                            <p class="text-center"> <i class="bi bi-clock-fill"></i> {{ $model->formatEndTime() }} </p>
                                        </div>
                                    </div>
                                @else

                                @endif
                            </td>
                        @endif

                    @endforeach
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>

</div>