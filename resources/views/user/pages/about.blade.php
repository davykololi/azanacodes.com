@extends('layouts.app')
    
@section('content')  
  <main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/about') }}">{{ Breadcrumbs::render('about') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Who We Are And What We Do</h3>
              <h2>Magnific Coding Kenya is a web design and development company based in Kenya, Bungoma County along Moi Avenue Street.</h2>
              <p>
                We design and develop websites in various categories such as E-commerce, Co-operate, Saas and Blogs. Our company has a dedicated team of competent and hardworking developers who cares about the needs of our customers. We use the latest state of the art technologies such as Laravel, React Js, Vue js, HTML and Jquery. We value and respect our clients so much and we strive our best level to satisfy their needs. You can <a href="{{ route('contact') }}">Contact</a> or call us on <a href="tel:+254 724351952"><i class="fa fa-phone"></i>+254 724351952</a>. 
              </p>
              <p>
                We also provide very educative programming tutorials to our esteemed readers. For those interested in programming, our <a href="{{ route('blog') }}">blog</a> is ever updated with the latest information to suit your needs. In case you have any pressing issues related to coding, we are always ready to help.
              </p>
              <blockquote>
                <i style="color:blue">Dear our esteemed reader, we value your readership and dedication for visiting this site. Enjoy reading our blog articles</i>
                <p>
                  <button class="btn btn-primary">
                    <a href="{{ route('blog') }}"><span style="color: white;">Blog Tutorials</span></a>
                  </button> 
                </p>
              </blockquote>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('assets/img/about.jpg') }}" class="img-fluid" alt="frency media about us">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->
  </main><!-- End #main -->
@endsection