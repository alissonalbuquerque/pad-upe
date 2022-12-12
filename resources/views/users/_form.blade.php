<!-- Tabs -->
<div>
    <ul class="nav nav-tabs">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-container" type="button" role="tab" aria-controls="user-container" arial-selected="true"> Usuário </button>
        </li>
        @if( $model->exists )
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="paper-tab" data-bs-toggle="tab" data-bs-target="#paper-container" type="button" role="tab" aria-controls="paper-container" arial-selected="false"> Papeis </button>
            </li>
        @endif
    </ul>
</div>

<!-- Panels -->
<div id="tab-containers" class="tab-content">

    <div id="user-container" class="tab-pane fade show active" role="tabpanel" aria-labelledby="user-tab">
        <div class="border border-rounded mt-2 p-2">
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
                            <select class="form-select" name="status" id="status">
                                @foreach($status as $value => $text)
                                    @if($model->status == $value)
                                        <option value="{{ $value }}" selected> {{ $text }} </option>
                                    @else
                                        <option value="{{ $value }}"> {{ $text }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                
                @if( $model->exists )
                    <div class="mb-4 col-6">
                        <div class="form-group">
                            <label class="form-label" for="curso_id"> Curso </label>
                            <select class="form-select" name="curso_id" id="curso_id">
                                <option value="" disabled selected hidden> Selecione... </option>
                                @foreach([] as $option)

                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                @if( $model->exists )
                    <div class="mb-4 col-6">
                        <div class="form-group">
                            <label class="form-label" for="campus_id"> Campus </label>
                            <select class="form-select" name="campus_id" id="campus_id">
                                <option value="" disabled selected hidden> Selecione... </option>
                                @foreach([] as $option)

                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if( $model->exists )
        <div id="paper-container" class="tab-pane fade" role="tabpanel" aria-labelledby="paper-tab">
            <div class="border border-rounded mt-2 p-2">
                <div class="row">

                </div>
            </div>
        </div>
    @endif

    <div class="mt-1 text-end">
        <div class="modal-footer">
            @if( !$model->exists )
                @include('components.buttons.btn-save', ['content' => 'Cadastrar'])
            @endif

            @if( $model->exists )
                @include('components.buttons.btn-save', ['content' => 'Atualizar'])
            @endif

            @include('components.buttons.btn-cancel', ['content' => 'Cancelar', 'route' => route('user_index')])
        </div>
    </div>

</div>
