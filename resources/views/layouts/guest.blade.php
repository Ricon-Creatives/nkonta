<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" href="{{ asset('img/favicon.png') }}" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        <div class="relative pt-6 px-4 sm:px-6 lg:px-8 bg-white shadow-sm">
            <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
              <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                <div class="flex items-center justify-between w-full md:w-auto">
                  <a href="/">
                    <span class="sr-only">Nkonta</span>
                    <img src="{{asset('img/logo-01.png') }}" class="h-20 w-auto" />
                </a>
                </div>
              </div>
              <div class="md:block md:ml-10 md:pr-4 md:space-x-6">

                @if (Route::has('login'))

            @auth
                <a href="{{ url('/home') }}" class="text-gray-500 font-medium dark:text-gray-500">Home</a>
            @else
            @endauth
                <a href="{{ url('/pricing') }}" class="ml-1text-gray-500 font-medium dark:text-gray-500">Pricing</a>
                <a href="{{ url('/about') }}" class="ml-1 text-gray-500 font-medium dark:text-gray-500">About</a>
              @guest
                <a href="{{ route('login') }}" class="ml-1 text-gray-500 font-medium dark:text-gray-500">Log in</a>
               @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-1 text-gray-500 font-medium dark:text-gray-500">Register</a>
               @endif
              @endguest
             @endif

              </div>
            </nav>
          </div>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <!--Footer-->
    <footer class="bg-gray-200 text-center lg:text-left block">
        <div class="text-gray-700 text-center p-4" style="">
            © 2022 Copyright:
            <a class="text-gray-800" href="https://nkonta.com/">Nkonta</a>
        </div>
    </footer>
    </body>
</html>
