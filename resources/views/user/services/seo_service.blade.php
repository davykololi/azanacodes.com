@extends('layouts.app')
    
@section('content')  
  <main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/seo-service') }}">{{ Breadcrumbs::render('seo.service') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection
    <!-- ======= Private Policy Section ======= -->    
    <section class="seo">
      <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-9">
              <h1>Search Engine Optimization Services</h1>
              <div class="seo-content">
                <p>
                  At Magnific Coding Kenya Limited we provided the following SEO services
                </p>
              </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-3">
              <h3>SEO Aside</h3>
            </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
@endsection