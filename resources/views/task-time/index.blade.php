@extends('layouts.main')

@section('title', 'Início')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', ['menu' => $menu])
@endsection

@section('body')

<div class="container">

    @include('components.alerts')

    @include('components.buttons.btn-show-modal', [
        '_class' => 'btn-success',
        '_content' => 'Cadastrar',
        '_target_class' => 'task-time-create',
    ])

    @php
        use App\Models\TaskTime;

        // $hours = ['07:30', '08:20', '09:10', '10:00', '10:50', '11:40', '12:30', '13:30', '14:30', '15:30', '16:30', '17:30', '19:00', '19:45', '20:30', '21:15'];

        $rangeHours = [
            ['07:30', '08:20'],
            ['08:20', '09:10'],
            ['09:10', '10:00'],
            ['10:00', '10:50'],
            ['10:50', '11:40'],
            ['11:40', '12:30'],
            ['12:30', '13:30'],
            ['13:30', '14:30'],
            ['14:30', '15:30'],
            ['15:30', '16:30'],
            ['16:30', '17:30'],
            ['17:30', '19:00'],
            ['19:00', '19:45'],
            ['19:45', '20:30'],
            ['20:30', '21:15'],
            ['21:15', '21:15'],
        ];

        $calendar = [];

        $row = [];

        foreach ($rangeHours as $rangeHour)
        {   
            $start_time = $rangeHour[0];
            $end_time = $rangeHour[1];

            $row[0] = $start_time;

            foreach (array_keys(TaskTime::listWeekDays()) as $weekday)
            {   
                $row[$weekday] = 
                    TaskTime::where('user_pad_id', '=', $user_pad_id)
                            ->where('weekday', '=', $weekday)
                            ->where(function($query) use ($rangeHour) {
                                $query->orWhereBetween('start_time', $rangeHour)->orWhereBetween('end_time', $rangeHour);
                            })->first();
                
                $row[$weekday] = $row[$weekday] ? $row[$weekday] : '';
            }

            $calendar[] = $row;
        }
    @endphp

    <div class="my-4">

        <table class="table table-hover">
            <thead>
                <tr>
                    @foreach(TaskTime::listWeekDaysTable() as $key => $weekday)
                        <th scope="col">{{$weekday}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($calendar as $rowHour)
                    <tr>
                    @foreach ($rowHour as $model)

                        @if(gettype($model) == 'string')
                            <th scope="col">{{ $model }}</th>
                        @endif

                        @if(gettype($model) == 'object')
                            <td>
                                <a href="#modal" class="btn btn-edit_task" id="{{ $model->id }}">
                                    {{ "{$model->getCode()} : {$model->getName()}" }}
                                </a>
                            </td>
                        @endif

                    @endforeach
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>

    @include('components.modal', ['size' => 'modal-lg', 'header' => ''])

</div>

@endsection

@section('scripts')

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('TaskTimeCreate', ['user_pad_id' => $user_pad_id]),
        'btn_class' => 'task-time-create',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('TaskTimeEdit'),
        'btn_class' => 'btn-edit_task',
    ])

@endsection

{{-- @include('components.buttons.btn-edit', [
    'route' => route('TaskTimeEdit', ['id' => $model->id])
])

@include('components.buttons.btn-delete', [
    'id' => $model->id,
    'route' => route('TaskTimeDelete', ['id' => $model->id])
]) --}}

{{-- @foreach($listTaskTime as $key => $taskTimes)
<tr>
    @foreach($taskTimes as $model)
        
            @if(gettype($model) == 'string')
                <th>{{ $model }}</th>
            @endif
                
            @if(gettype($model) == 'object')
                
            @endif
        
    @endforeach
</tr>
@endforeach --}}