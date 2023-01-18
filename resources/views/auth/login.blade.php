<x-guest-layout>
    <!-- Session Status -->
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div>
            Пользователь обнаружен
        </div>
        <div>
            Логин: {{ \Illuminate\Support\Facades\Session::get('login') }}
        </div>
        <div>
            Токен: {{ \Illuminate\Support\Facades\Session::get('token') }}
            <input type="hidden"
                   id="tokenKey"
                   value="{{ \Illuminate\Support\Facades\Session::get('token') }}"/>
        </div>
        <div>
            <a style="font-weight: bold; color: red" href="/">На главную</a>
        </div>
    @else
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    @endif
</x-guest-layout>
<script>
    getToken();

    function getToken() {
        let inputField = document.querySelector('#tokenKey')
        if (inputField != null) {
            localStorage.setItem('token', inputField.value)
        }
    }
</script>
