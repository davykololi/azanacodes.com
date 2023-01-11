<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@include('partials.frontend_head')
<body>
    @include('partials.frontend_header')	
	<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <h2>{{ $errorCode }}</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        	<div class="flex justify-center max-w-5xl min-h-screen pb-16 mx-auto">
  				<div class="leading-none text-center text-black md:text-left">
		  			<h1 class="mb-2 text-5xl font-extrabold">{{ $errorCode }}</h1>
					<p class="text-xl text-gray-900">
						@isset($title)
								{{ $title }}
						@else
								Hello, is it me you're looking for?
						@endisset

						@if($homeLink ?? false)
								<a href="{{ url('/') }}" class="font-bold underline transition duration-300 hover:text-blue-600">Go home</a>
						@endif
					</p>
				</div>
			</div>
      </div>
    </section>

  </main><!-- End #main -->
	@include('partials.frontend_footer')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    @include('partials.frontend_scripts')
</body>
</html>