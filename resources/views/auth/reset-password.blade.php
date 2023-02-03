@extends('auth.main')

@section('body')
<!-- Container principal -->
<div class="ftco-section">
    <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    
            <div class="login-wrap p-5" style="width: 500px;">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="alert alert-danger mb-2" :errors="$errors" />

            
                    <div class="w-100">
                        <h4 class="mb-4">Redefinir senha</h4>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="form-group mt-3">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="form-control" type="email" name="email"
                                :value="old('email', $request->email)" required autofocus />
                        </div>

                        <!-- Password -->
                        <div class="form-group mt-3">
                            <x-label for="password" :value="__('Nova Senha')" />

                            <x-input id="password" class="form-control" type="password" name="password" required />
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mt-3">
                            <x-label for="password_confirmation" :value="__('Confirmar Senha')" />

                            <x-input id="password_confirmation" class="form-control" type="password"
                                name="password_confirmation" required/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="form-control btn btn-secondary rounded submit px-3">
                                Redefinir senha
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection