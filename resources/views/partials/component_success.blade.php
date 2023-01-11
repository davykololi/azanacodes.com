@component('components.alert')
	@slot('class')
		success
	@endslot

	@slot('title')
		@include('partials.messages')
	@endslot
@endcomponent