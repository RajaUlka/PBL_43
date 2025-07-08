<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
    <div class="bg-white/60 backdrop-blur-md p-10 rounded-2xl shadow-2xl w-full max-w-xl">
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('image/logo-admin.png') }}" alt="Logo" class="w-16 h-16">
                <h1 class="text-xl font-semibold mt-2 text-center text-gray-800">
                    Daftar Akun Baru
                </h1>
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-label for="name" value="Nama" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="Password" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="Konfirmasi Password" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <label for="terms" class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <span class="ms-2 text-sm text-gray-600">
                                {!! __('Saya setuju dengan :terms_of_service dan :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-gray-900">'.__('Syarat Layanan').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-gray-900">'.__('Kebijakan Privasi').'</a>',
                                ]) !!}
                            </span>
                        </label>
                    </div>
                @endif

                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Sudah punya akun?
                    </a>
                    <x-button class="ms-4">
                        Daftar
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
