@if(session()->has('message'))
<div class="absolute right-0 p-1">
    <div class="flex items-center px-4 py-4 rounded  text-slate-800 bg-slate-300" role="alert">
        <p>{{ session()->get('message') }}</p>
    </div>
  </div>
@endif
<x-guest-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 bg-gray-100 items-center p-2">
    <div class="hidden sm:block">

    <main class="flex justify-center mx-auto max-w-7xl px-5 sm:px-6">
        <div class="text-center lg:text-center">
            <h2 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-5xl">
            <span class="block xl:inline">Know how well your business is doing with</span>
            </h2>
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block text-purple-900 xl:inline"><a href="/">nkonta.</a></span>
                </h1>
            <p class="mt-2 text-base text-gray-500 sm:mt-3 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-3 md:text-xl lg:mx-0">
                Smart book keeping for small business.
            </p>
        </div>
        </main>

    </div>

    <div>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
              <!--  <x-application-logo class="h-20 w-auto" />-->
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>


            <div class="flex items-center justify-center mt-4">
                <x-button class="w-full text-center justify-center">
                    {{ __('Log in') }}
                </x-button>
            </div>

            <!-- Forgot your password -->
            <div class="block mt-3 text-center">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            </div>
            <div class="block mt-3 text-center items-center border-t border-gray-200 pt-3">
            <a type="button" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-900 active:bg-green-600 focus:outline-none focus:border-gray-900
                    disabled:opacity-25 transition ease-in-out duration-150" href="{{ route('register') }}">
                {{ __('Create an account') }}
            </a>
            </div>
        </form>
    </x-auth-card>
    </div>
    </div>
</x-guest-layout>
