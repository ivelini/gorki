<x-guest-layout>
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div>
            Пользователь зарегистрирован
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
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
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
