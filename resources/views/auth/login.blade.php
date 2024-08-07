@extends('auth.main')

@section('body')
<!-- Container principal -->
<div class="ftco-section">

    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-7">
            <div class="login-wrap">

                <!-- Validation Errors -->
                <x-auth-validation-errors class="alert alert-danger mb-2" :errors="$errors" />

                <!-- Session Status -->
                @include('components.alerts')

                <form action="{{ route('login') }}" method="POST" class="signin-form d-md-flex">
                    @csrf                    

                    <!-- Informações -->
                    <div class="half p-4 py-md-5 bg-primary">
                        <div class="w-100">
                            <h4 class="mb-4"> Bem-vindo(a) ao PDA! </h4>
                        </div>
                        <p class="w-100 text-center"> Como entrar pela primeira vez: </p>
                        <!-- <p class="w-100 text-center text-danger"> Serviço em ajuste. Em breve, será novamente liberado </p> -->
                        <p class="w-100 text-center"> O primeiro acesso deve ser realizado utilizando o seu e-mail institucional como login e parte local do email como senha. </p>
                        <p class="w-100 font-weight-bold"> Exemplo: </p>
                        <p class="w-100 font-weight-bold"> <span class="bold"> Login: </span> usuario.email@upe.br </p>
                        <p class="w-100 font-weight-bold"> <span class="bold"> Senha: </span> usuario.email </p>

                        <!-- <p class="w-100 text-center">O primeiro acesso deve ser realizado utilizando seu e-mail
                            e CPF, nos campos de login e senha respectivamente</p> -->
                    </div>

                    <!-- Login -->
                    <div class="half p-4 py-md-5">
                        <div class="w-100">
                            <h4 class="mb-4"> Login </h4>
                        </div>
                        <div class="form-group mt-3">
                            <label class="label" for="name"> E-mail </label>
                            <input type="email" name="email" class="form-control" placeholder="email@upe.br" :value="old('email')" required
                                autofocus />
                        </div>
                        <div class="form-group">
                            <label class="label" for="password"> Senha </label>
                            <input id="password-field" type="password" name="password" class="form-control"
                            :value="__('Password')" placeholder="senha" required />
                            <span toggle="#password-field"
                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-secondary rounded submit px-3">Entrar</button>
                        </div>
                        <div>
                            <a href="{{ route('password.request') }}">Esqueci minha senha</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
@endsection