<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name | Dashboard',) }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/tailwind.output.css')}}" />

        <!-- Scripts -->
        <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer
        ></script>
        <script src="{{ asset('js/init-alpine.js') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
      @include('admin.layouts.sidenav')
      <div class="flex flex-col flex-1 w-full">
          @include('admin.layouts.header')
          <main class="h-full overflow-y-auto">
            <div class="container px-6 mx-auto grid">

            </div>
          </main>
      </div>
        </div>
    </body>
</html>
