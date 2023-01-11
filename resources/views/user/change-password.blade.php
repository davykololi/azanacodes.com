@extends('layouts.app')
@section('title')
    Change Password
@endsection

@section('content')
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/visitor/change-password') }}">{{ Breadcrumbs::render('visitor.change.password') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <div class="row ">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>

                <div class="card-body">
                    @include('partials.messages')
                    @include('partials.errors')
                    <form method="POST" action="{{route('visitor.change.password')}}">
						@csrf
						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
							<div class="col-md-6">
								<input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current_password">
								@error('current_password')
								<span class="invalid-feedback" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
							<div class="col-md-6">
								<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="password">
								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">Password Confirmation</label>
							<div class="col-md-6">
								<input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="password_confirmation">
								@error('password_confirmation')
								<span class="invalid-feedback" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary btn-sm">Change Password</button>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
  </main><!-- End #main -->
@endsection