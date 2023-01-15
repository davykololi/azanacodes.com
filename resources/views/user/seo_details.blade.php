@extends('layouts.app')
    
@section('content')  
  <main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/services/seo') }}">{{ Breadcrumbs::render('services.seo') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection
    <!-- ======= Private Policy Section ======= -->    
    <section class="inner-page">
      <div class="container">
        <p>
          SEO Page
        </p>
      </div>
    </section>
  </main><!-- End #main -->
@endsection