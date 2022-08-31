<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" href="{{ asset('img/favicon.png') }}" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Nkonta') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <style>
            [x-cloak] {
                display: none;
            }
        </style>
        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
      <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" ></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/index.js') }}"></script>

    </head>
    <body class="font-sans antialiased">
        <div  x-data="{ open: false }"  class="min-h-screen bg-gray-100">
            @include('layouts.sidebar')

        </div>

        <script>
            var chatbox = document.getElementById('fb-customer-chat');
            chatbox.setAttribute("page_id", "191880054806731");
            chatbox.setAttribute("attribution", "biz_inbox");
          </script>

         <!-- Messenger Chat Plugin Code -->
          <div id="fb-root"></div>

          <!-- Your Chat Plugin code -->
          <div id="fb-customer-chat" class="fb-customerchat">
          </div>

          <script>
            var chatbox = document.getElementById('fb-customer-chat');
            chatbox.setAttribute("page_id", "106828342098050");
            chatbox.setAttribute("attribution", "biz_inbox");
          </script>

         <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v14.0'
          });
        };

        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>
    </body>
</html>
