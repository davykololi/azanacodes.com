<footer>
	@can('isAdmin')
		@include('partials.ext_backend_footer')
	@endcan

	@can('isEditor')
		@include('partials.ext_backend_footer')
	@endcan

	@can('isAuthor')
		@include('partials.ext_backend_footer')
	@endcan
</footer>