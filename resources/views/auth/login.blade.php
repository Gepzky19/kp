@php
    use Illuminate\Support\Facades\Route;
@endphp

<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
        <!-- Logo -->
        <div>
            <a href="/">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Iskandartex Logo" class="w-20 h-20 mb-6">
            </a>
        </div>

        <!-- Card -->
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
            

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form id="loginForm" method="POST" action="{{ route('user.login') }}">
                @csrf

                <!-- Role Select -->
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Login sebagai</label>
                    <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">Ingat saya</label>
                </div>

                <!-- Action -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif

                    <x-primary-button class="ml-3">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
                <div class="mt-4 text-center">
    <p class="text-sm text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">
            Daftar sekarang
        </a>
    </p>
</div>
            </form>
        </div>
    </div>

    <!-- Script untuk handle role -->
    <script>
        const loginForm = document.getElementById('loginForm');
        const roleSelect = document.getElementById('role');

        function updateAction() {
            loginForm.action = roleSelect.value === 'admin'
                ? "{{ route('admin.login') }}"
                : "{{ route('user.login') }}";
        }

        roleSelect.addEventListener('change', updateAction);
        updateAction(); // Initial set
    </script>
</x-guest-layout>
