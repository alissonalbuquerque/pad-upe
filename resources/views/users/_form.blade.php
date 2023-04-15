@php

    $userTabActive = '';
    $userContainerActive = '';

    $paperTabActive = '';
    $paperContainerActive = '';

    if($tab == 'user')
    {
        $userTabActive = 'active';
        $userContainerActive = 'show active';
    }

    if($tab == 'paper')
    {
        $paperTabActive = 'active';
        $paperContainerActive = 'show active';
    }

@endphp

<!-- Tabs -->
<div>
    <ul class="nav nav-tabs">
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $userTabActive }}" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-container" type="button" role="tab" aria-controls="user-container" arial-selected="true"> Usuário </button>
        </li>
        @if( $model->exists )
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $paperTabActive }}"" id="paper-tab" data-bs-toggle="tab" data-bs-target="#paper-container" type="button" role="tab" aria-controls="paper-container" arial-selected="false"> Papeis </button>
            </li>
        @endif
    </ul>
</div>

<!-- Panels -->
<div id="tab-containers" class="tab-content">

    <div id="user-container" class="tab-pane fade {{ $userContainerActive }}" role="tabpanel" aria-labelledby="user-tab">
        <div class="mt-2 px-2">

            <form action="{{ $action }}" method="POST">
                <div class="row">

                    @csrf

                    <div class="mb-4 col-12">
                        <div class="form-group">
                            <label class="form-label" for="name"> Nome </label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nome" value="{{ $model->exists ? $model->name : old('name') }}">
                            @include('components.divs.errors', ['field' => 'name'])
                        </div>
                    </div>

                    <div class="mb-4 col-12">
                        <div class="form-group">
                            <label class="form-label" for="email"> E-Mail </label>
                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-Mail" value="{{ $model->exists ? $model->email : old('email') }}">
                            @include('components.divs.errors', ['field' => 'email'])
                        </div>
                    </div>

                    @if( $model->exists )
                        <div class="mb-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="status"> Status </label>
                                <select class="form-control" name="status" id="status">
                                    @foreach($status as $value => $text)
                                        @if($model->status == $value)
                                            <option value="{{ $value }}" selected> {{ $text }} </option>
                                        @else
                                            <option value="{{ $value }}"> {{ $text }} </option>
                                        @endif
                                    @endforeach
                                </select>
                                
                                @include('components.divs.errors', ['field' => 'status'])
                            </div>
                        </div>
                    @endif

                    @if( $model->exists )
                        <div class="mb-4 col-6">
                            <div class="form-group">
                                <label class="form-label" for="campus_id"> Campus </label>
                                <select class="form-control" name="campus_id" id="campus_id">
                                    @if($model->campus_id) 
                                        <option value="{{$model->campus_id}}" selected> {{$model->campus}} </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif

                    @if( $model->exists )
                        <div class="mb-4 col-6">
                            <div class="form-group">
                                <label class="form-label" for="curso_id"> Curso </label>
                                <select class="form-control" name="curso_id" id="curso_id">
                                    @if($model->curso_id) 
                                        <option value="{{$model->curso_id}}" selected> {{$model->curso}} </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-1 text-end">

                    @php
                        $btnSaveContent = !$model->exists ? 'Cadastrar' : 'Atualizar';
                    @endphp
                    
                    @include('components.buttons.btn-save', ['content' => $btnSaveContent])

                    @include('components.buttons.btn-cancel', ['content' => 'Cancelar', 'route' => route('user_index')])
                </div>
            </form>

        </div>
    </div>

    @if( $model->exists )
        <div id="paper-container" class="tab-pane fade {{ $paperContainerActive }}" role="tabpanel" aria-labelledby="paper-tab">

            <div class="text-end my-2">
                <button type="button" class="btn btn-success user-type-create"> Cadastrar Papel </button>
            </div>

            <div class="border rounded px-2">

                <table id="user_pad-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col"> Usuário </th>
                            <th scope="col"> Papel </th>
                            <th scope="col"> Status </th>
                            <th scope="col"> Opções </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($profiles as $profile)
                        <tr>
                            <td>{{ $profile->user }}</td>
                            <td>{{ $profile->typeAsString() }}</td>
                            <td>{{ $profile->statusAsString() }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <div class="me-1">
                                        @include('components.buttons.btn-edit-task', [
                                            'btn_class' => 'btn-edit_user_type',
                                            'btn_id' => $profile->id,
                                        ])
                                    </div>
                                    <div class="me-1">
                                        @include('components.buttons.btn-delete', [
                                            'id' => $profile->id,
                                            'btn_class' => 'btn btn-danger',
                                            'route' => route('user-type_delete', ['id' => $profile->id])
                                        ])
                                    </div>
                                </div>    
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @endif
</div>
