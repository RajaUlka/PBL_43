<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center">
                <x-authentication-card-logo />
                <h1 class="text-xl font-semibold mt-2">Sistem Monitoring Kualitas Air</h1>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif

                <x-button>
                    {{ __('Masuk') }}
                </x-button>
            </div>
        </form>

        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 underline text-sm">
                ← Kembali ke Beranda
            </a>
        </div>
    </x-authentication-card>
</x-guest-layout>
