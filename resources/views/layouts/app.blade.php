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
        @include('layouts.partials.navigation') <!-- always -->


        <!-- Navigation -->
    @include('sections.nav')
    <div class="" v-if="Authication">
    <!-- Header -->
    @include('sections.header') 

    <!-- Services -->
    @include('sections.events')
    <!-- Portfolio Grid -->
    @include('sections.portfolio')

    <!-- About -->
    @include('sections.about')

    <!-- Team -->
    @include('sections.team')

    <!-- Clients -->
    @include('sections.clients')

    <!-- Contact -->
    @include('sections.contact')

    <!-- Footer -->
    @include('sections.footer')

    <!-- Portfolio Modals -->

    <!-- Modal 1 -->
    @include('modals.modal_one')

    <!-- Modal 2 -->
    @include('modals.modal_two')

    <!-- Modal 3 -->
    @include('modals.modal_three')

    <!-- Modal 4 -->
    @include('modals.modal_four')

    <!-- Modal 5 -->
    @include('modals.modal_five')

    <!-- Modal 6 -->
    @include('modals.modal_six')
</div>


    @yield('content') <!-- depends on which route was called -->
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
