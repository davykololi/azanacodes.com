@extends('layouts.app')
    
@section('content')  
  <main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/services/backend') }}">{{ Breadcrumbs::render('services.backend') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection
    <!-- ======= Private Policy Section ======= -->    
    <section class="inner-page">
      <div class="container">
        <p>
          Backend Programming Page
        </p>
      </div>
    </section>
  </main><!-- End #main -->
@endsection