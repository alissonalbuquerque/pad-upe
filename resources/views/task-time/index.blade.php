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

        $calendar = [];

        $weekColumns = [];

        $max_len_column = 0;
        foreach (array_keys(TaskTime::listWeekDays()) as $weekday) {
            
            $weekColumns[$weekday] = 
                                    TaskTime::whereWeekday($weekday)
                                        ->orderBy('start_time', 'ASC')
                                        ->get();

            if(count($weekColumns[$weekday]) > $max_len_column) {
                $max_len_column = count($weekColumns[$weekday]);
            }
        }

        foreach (range(0, $max_len_column-1) as $i) {
            $row = [];
            foreach (array_keys(TaskTime::listWeekDays()) as $weekday) {

                isset($weekColumns[$weekday][$i]) ? array_push($row, $weekColumns[$weekday][$i]) : array_push($row, null);
            }
            $calendar[] = $row;
        }
    @endphp

    <div class="my-4">

        <table class="table table-hover">
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
                                <div class="card">
                                    <div class="card-header">
                                        <p class="text-center"> <i class="bi bi-clock"></i> {{ $model->formatStartTime() }} </p>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <a href="#modal" class="btn btn-edit_task" id="{{ $model->id }}">
                                                {{ "{$model->getCode()} : {$model->getName()}" }} <i class="bi bi-pencil"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <p class="text-center"> <i class="bi bi-clock-fill"></i> {{ $model->formatEndTime() }} </p>
                                    </div>
                                </div>
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
        'route' => route('task_time_create', ['user_pad_id' => $user_pad_id]),
        'btn_class' => 'task-time-create',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('task_time_edit'),
        'btn_class' => 'btn-edit_task',
    ])

@endsection