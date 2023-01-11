<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@include('partials.frontend_head')
<body>
    @include('partials.frontend_header')
    @yield('breadcrumbs')
    @yield('content')
    @include('partials.frontend_footer')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    @include('partials.frontend_scripts')
    @push('scripts')
</body>
</html>
