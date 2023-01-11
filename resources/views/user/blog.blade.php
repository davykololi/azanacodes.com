@extends('layouts.app')
    
@section('content')
<main id="main">
  @section('breadcrumbs')
  <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/blog') }}">{{ Breadcrumbs::render('blog') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
  @endsection
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          @include('partials.errors')
          @include('partials.messages')
          <div class="col-lg-8 entries">
            @if(!empty($featuredArticles))
            @forelse($featuredArticles as $article)
              @include('article')
            @empty
            <p class="text-danger">No Articles</p>
            @endforelse
            @endif
            <div>
              {{ $featuredArticles->links() }}
            </div>
          </div><!-- End blog entries list -->
          @include('partials.frontend_sidebar')  
        </div>
      </div>
    </section><!-- End Blog Section -->
    @include('laravel_tutorials')<!-- Laravel Tutorials -->
    @include('reactjs_tutorials')<!-- React js Tutorials -->
    @include('tailwindcss_tutorials')<!-- Tailwind css Tutorials -->
    @include('vuejs_tutorials')<!-- Vue Js Tutorials -->
    @include('all_articles')<!-- Recent Articles -->
    @include('about_intro')<!-- About Us Introduction -->
    @include('faq.faq')<!-- Frequently Asked Questions -->
</main><!-- End #main -->
@endsection