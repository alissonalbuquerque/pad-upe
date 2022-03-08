<x-guest-layout>

    <slot name="logo">
        <a href="/">
            <application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </slot>

    <!-- Session Status -->
    <auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" :value="__('Email')" />

            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" :value="__('Password')" />

            <input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button class="ml-3 btn btn-primary">
                {{ __('Log in') }}
            </button>
        </div>
    </form>

</x-guest-layout>
