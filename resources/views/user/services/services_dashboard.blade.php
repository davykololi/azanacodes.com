@extends('layouts.app')
    
@section('content')
  <main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/services') }}">{{ Breadcrumbs::render('services') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection    
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Services</h2>
          <p>Magnific Coding Offered Services</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-box blue">
              <a href="{{ route('seo.service') }}"><i class="ri-discuss-line icon"></i></a>
              <h3>Search Engine Optimization Services</h3>
              <p>We have extensive knowledge in Search Engine Optimization and therefore .....</p>
              <a href="{{ route('seo.service') }}" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-box orange">
              <a href="{{ route('webdevpt.service') }}"><i class="ri-discuss-line icon"></i></a>
              <h3>Web Design And Development Services</h3>
              <p>We design and develop beautiful websites using the latest technologies.</p>
              <a href="{{ route('webdevpt.service') }}" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-box green">
              <i class="ri-discuss-line icon"></i>
              <h3>Ledo Markt</h3>
              <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-box red">
              <i class="ri-discuss-line icon"></i>
              <h3>Asperiores Commodi</h3>
              <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-box purple">
              <i class="ri-discuss-line icon"></i>
              <h3>Velit Doloremque.</h3>
              <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
            <div class="service-box pink">
              <i class="ri-discuss-line icon"></i>
              <h3>Dolori Architecto</h3>
              <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

        <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Pricing</h2>
          <p>Check our Pricing</p>
        </header>

        <div class="row gy-4" data-aos="fade-left">

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="box">
              <h3 style="color: #07d5c0;">Free Plan</h3>
              <div class="price"><sup>$</sup>0<span> / mo</span></div>
              <img src="assets/img/pricing-free.png" class="img-fluid" alt="Pricing Free" loading="lazy">
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li class="na">Pharetra massa</li>
                <li class="na">Massa ultricies mi</li>
              </ul>
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="box">
              <span class="featured">Featured</span>
              <h3 style="color: #65c600;">Starter Plan</h3>
              <div class="price"><sup>$</sup>19<span> / mo</span></div>
              <img src="assets/img/pricing-starter.png" class="img-fluid" alt=" Pricing Starter" loading="lazy">
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li>Pharetra massa</li>
                <li class="na">Massa ultricies mi</li>
              </ul>
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="box">
              <h3 style="color: #ff901c;">Business Plan</h3>
              <div class="price"><sup>$</sup>29<span> / mo</span></div>
              <img src="assets/img/pricing-business.png" class="img-fluid" alt=" Pricing Business" loading="lazy">
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li>Pharetra massa</li>
                <li>Massa ultricies mi</li>
              </ul>
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="box">
              <h3 style="color: #ff0071;">Ultimate Plan</h3>
              <div class="price"><sup>$</sup>49<span> / mo</span></div>
              <img src="assets/img/pricing-ultimate.png" class="img-fluid" alt="Pricing Ultimate" loading="lazy">
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li>Pharetra massa</li>
                <li>Massa ultricies mi</li>
              </ul>
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Pricing Section -->
  </main><!-- End #main -->
@endsection