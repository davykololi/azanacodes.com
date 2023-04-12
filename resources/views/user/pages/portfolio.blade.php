@extends('layouts.app')
    
@section('content')  
  <main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/portfolio') }}">{{ Breadcrumbs::render('portfolio') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="{{ asset('assets/img/portfolio/portfolio-10.png') }}" alt="Magnific Coding Portfolio Page Photo">
                </div>

                <div class="swiper-slide">
                  <img src="{{ asset('assets/img/portfolio/portfolio-1.png') }}" alt="Magnific Coding Home Page Photo">
                </div>

                <div class="swiper-slide">
                  <img src="{{ asset('assets/img/portfolio/portfolio-2.png') }}" alt="Magnific Coding Portfolio Contact Page Photo">
                </div>

                <div class="swiper-slide">
                  <img src="{{ asset('assets/img/portfolio/portfolio-3.jpg') }}" alt="Magnific Coding Portfolio Image Three">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Project information</h3>
              <ul>
                <li><strong>Category</strong>: Web Design & Development</li>
                <li><strong>Client</strong>: Magnigic Coding Company</li>
                <li><strong>Project date</strong>: 01 Dec, 2022</li>
                <li><strong>Project URL</strong>: <a href="{{ route('home') }}">www.magnificcoding.com</a></li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>Magnific Coding Portfolio</h2>
              <p style="color: green;">
                This is just some one of the project that we worked on. It's a blog application using laravel framework. The best laravel practices were employed in the development of this application hence ensuring that it meets the requirements of the end user and search engines.
              </p> 
              <p style="color: blue;">
                We built nearly all types of websites and these include Corperate, E-Commerce, Saas, E-learning e.t.c. We start from idea, design, development, deployment in remote servers, continous deployment and integration.
              </p>
              <p>
                Therefore if you have any project that involves use of laravel, wordpress, react js, and vue js, don't hestate to contact us. We value our customers and will always deliver their work.You are all welcome.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Portfolio Details Section -->
  </main><!-- End #main -->
@endsection