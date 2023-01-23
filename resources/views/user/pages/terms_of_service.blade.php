@extends('layouts.app')
    
@section('content')  
  <main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/service') }}">{{ Breadcrumbs::render('service') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection
    <!-- ======= Terms Of Service Section ======= -->    
    <section class="inner-page">
      <div class="container">
        <p>
          Terms of Service Page
        </p>
      </div>
    </section>
  </main><!-- End #main -->
@endsection