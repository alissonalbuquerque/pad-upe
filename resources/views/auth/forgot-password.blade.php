@extends('auth.main')

@section('body')
<!-- Container principal -->
<div class="ftco-section">

<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
        <div class="col-md-12 col-lg-7">
            <div class="login-wrap">

                <!-- Validation Errors -->
                <x-auth-validation-errors class="alert alert-danger mb-2" :errors="$errors" />

                @include('components.alerts')

                <div class="signin-form d-md-flex">
                    @csrf

                    <!-- Informações -->
                    <div class="half p-4 py-md-5 bg-primary">
                        <p class="w-100 text-center">&mdash; Esqueceu sua senha? &mdash;</p>
                        <p class="w-100 text-center">Sem problemas. Basta informar seu endereço de e-mail e enviaremos um e-mail com um link de redefinição de senha.</p>
                    </div>

                    <!-- Login -->
                    <div class="half p-4 py-md-5">
                        <div class="w-100">
                            <h4 class="mb-4">Redefinir senha</h4>
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                             <!-- Email Address -->
                            <div class="form-group mt-3">
                            <label class="label" for="name">Endereço de email</label>
                            <input type="email" name="email" class="form-control" placeholder="ex: usuario@upe.br" :value="old('email')" required autofocus />
                            </div>
                            <!-- Email Address -->

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="form-control btn btn-secondary rounded submit px-3"> Redefinir Senha </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection