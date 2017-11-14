<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/agency.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    <div id="app">
      @include('sections.nav')

    
      @yield('content') 
    </div>


    <!-- Scripts -->
     <script type="text/javascript">
          window.App = {!! json_encode([
            'signedIn' => Auth::check(),
            'user'   => Auth::user()
            ]) !!};
     </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
