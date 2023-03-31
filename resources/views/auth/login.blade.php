@extends('layouts.app')
@section('title')
    Login
@endsection

@section('content')
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/login') }}">{{ Breadcrumbs::render('login') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">
      <div class="container">
        <div class="row">
        <div class="col-lg-12 entries">
            <div class="card text-center text-white bg-primary mb-3 border-primary">
                <div class="card-header ctr bg-success">
                    <h1 class="white"><img src="{{ asset('static/login.png') }}" alt="login"></h1>
                </div>

                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-danger">{{session('message')}}</div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf 

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email Address" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" value="{{ old('remember') ? 'checked' : '' }}">

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <br/>
                        <div class="card-footer mt-3">
                            <div class="card-title"><b class="blue">{{ __('Login With:') }}</b></div>
                            <br/>
                            <div class="card-img-top" id="social-links">
                                <ul>
                                    <li><a href="{{ url('/login/twitter') }}"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="{{ url('/login/facebook') }}"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="{{ url('/login/linkedin') }}"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="{{ url('/login/google') }}"><i class="fab fa-google"></i></a></li>
                                    <li><a href="{{ url('/login/github') }}"><i class="fab fa-github"></i></a></li>
                                    <li><a href="{{ url('/login/bitbucket') }}"><i class="fab fa-bitbucket"></i></a></li>
                                </ul>
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




