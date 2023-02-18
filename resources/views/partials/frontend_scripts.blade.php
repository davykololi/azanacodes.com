	<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Meta Tags Scripts -->
    {!! JsonLd::generate() !!}
    <!-- Breadcrumb Scripts -->
    @include('partials.breadcrumbs_schema')
    <!-- Laravel Share Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/share.js') }}" async></script>
    <!--End Of Laravel Share Scripts -->
    <script src="{{ asset('fontawesome-5/js/all.min.js') }}" async></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   
   	<!-- Vendor JS Files -->
  	<script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}" async></script>
  	<script src="{{ asset('assets/vendor/aos/aos.js') }}" async></script>
  	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" async></script>
  	<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  	<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  	<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  	<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  	<!-- Template Main JS File -->
  	<script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- TinyMCE Scripts -->
    <script src="{{asset('prism/js/prism.js')}}"></script>





