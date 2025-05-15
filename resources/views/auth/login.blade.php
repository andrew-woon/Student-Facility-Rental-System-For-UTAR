<x-guest-layout>
    <x-slot name="header">
        {{ __('Login') }}
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('images/UTAR_Logo.jpg') }}" class="w-48 h-24 mx-auto mb-6" data-aos="fade-down" alt="UTAR Logo">
            </a>
        </x-slot>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full p-3 rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                         type="email" name="email" :value="old('email')" autofocus />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full p-3 rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                         type="password" name="password" autocomplete="current-password" />
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <x-input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"/>
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:text-blue-700 transition">
                        Forgot Your Password?
                    </a>
                @endif
            </div>

            <div class="flex justify-end items-center mt-4">
                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('New User? Register here!') }}
                </a>

                <x-button class="text-white hover:bg-gray-700 ml-4">
                    {{ __('Login') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
