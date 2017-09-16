<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Anita</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/agency.css') }}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  {{-- <link href="css/agency.min.css" rel="stylesheet"> --}}

</head>

<body id="page-top">

  <!-- Navigation -->
  @include('sections.nav')
  <!-- Header -->
  @include('sections.header') 

  <!-- Services -->
  @include('sections.services')
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

  <!-- Bootstrap core JavaScript -->


  <!-- Plugin JavaScript -->
  <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
   
    <!-- Contact form JavaScript -->
    <script src="{{ asset('js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('js/contact_me.js') }}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset('js/agency.min.js') }}"></script>

  </body>

  </html>