@extends('layouts.app')
    
@section('content')  
  <main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/website-development-service') }}">{{ Breadcrumbs::render('webdevpt.service') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection
    <!-- ======= Tailwind Css Section ======= -->    
    <section class="inner-page">
      <div class="container">
        <p>
          Web Design And Development Page
        </p>
      </div>
    </section>
  </main><!-- End #main -->
@endsection