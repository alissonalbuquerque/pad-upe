<x-guest-layout>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-7">
                    <div class="login-wrap">
                        <slot name="logo">
                            <a href="/">
                                <application-logo class="w-20 h-20 fill-current text-gray-500" />
                            </a>
                        </slot>

                        <!-- Session Status -->
                        <auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('login') }}" class="signin-form d-md-flex d-flex flex-row bd-highlight mb-3>
                            @csrf
                            <div class="half p-4 py-md-5 bg-primary">
                                <div class="w-100">
                                    <h4 class="mb-4">Informações</h4>
                                </div>
                                <p class="w-100 text-center">&mdash; Atenção &mdash;</p>
                                <p class="w-100 text-center">O primeiro acesso deve ser realizado utilizando seu e-mail
                                    e CPF, nos campos de login e senha respectivamente</p>
                            </div>

                            <div class="half p-4 py-md-5">
                                <div class="w-100">
                                    <h4 class="mb-4">Acesso PAD</h4>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="label" for="name">Endereço de email</label>
                                    <input type="email" name="email" :value="old('email')" required autofocus class="form-control"
                                        placeholder="ex: nome@upe.br" required autofocus />
                                </div>
                                <div class="form-group">
                                    <label class="label" for="password">Senha</label>
                                    <input name="password" id="password-field" type="password" class="form-control"
                                        placeholder="Senha" required />
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                        class="form-control btn btn-secondary rounded submit px-3">{{ __('Log in') }}</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0"
                                            style="color: rgb(22, 21, 21);">
                                            {{ __('Remember me') }}
                                            <input type="checkbox" checked />
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#" style="color: rgb(22, 21, 21);">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
