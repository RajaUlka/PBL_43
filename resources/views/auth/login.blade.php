<x-guest-layout>
        <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white/60 backdrop-blur-md p-10 rounded-2xl shadow-2x1 w-full max-w-xl">
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('image/logo-admin.png') }}" alt="Logo" class="w-16 h-16">
                <h1 class="text-xl font-semibold mt-2 text-center text-gray-800">
                    Sistem Monitoring Kualitas Air
                </h1>
            </div>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="Password" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif

                    <x-button>
                        Masuk
                    </x-button>
                </div>
            </form>

            <div class="text-center mt-6">
                <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 underline text-sm">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
