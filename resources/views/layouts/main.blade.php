@extends('layouts.app')

@section('content')
	<!-- Navigation -->
   {{--  @include('sections.nav') --}}
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

@stop

