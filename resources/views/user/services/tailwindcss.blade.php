@extends('layouts.app')
    
@section('content')  
  <main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/services/tailwindcss') }}">{{ Breadcrumbs::render('services.tailwindcss') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection
    <!-- ======= Tailwind Css Section ======= -->    
    <section class="inner-page">
      <div class="container">
        <p>
          Tailwind Css Programming Page
        </p>
      </div>
    </section>
  </main><!-- End #main -->
@endsection