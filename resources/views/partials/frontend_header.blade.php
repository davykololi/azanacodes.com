  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center">
        <img src="{{ asset('static/logo.png') }}" alt="{{ Config::get('app.name') }} logo">
        <span>{{ Config::get('app.name') }}</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto {{ request()->routeIs('home') ? 'active':'' }}" href="/">Home</a></li>
          <li><a class="nav-link scrollto {{ request()->routeIs('blog') ? 'active':'' }}" href="{{ route('blog') }}">Blog</a></li>
          <li><a class="nav-link scrollto {{ request()->routeIs('about') ? 'active':'' }}" href="{{ route('about') }}">About</a></li>
          <li>
            <a class="nav-link scrollto {{ request()->routeIs('services') ? 'active':'' }}" href="#services">Services</a>
          </li>
          <li><a class="nav-link scrollto {{ request()->routeIs('contact') ? 'active':'' }}" href="{{ route('contact') }}">Contact</a></li>
          <li>
            <a class="nav-link scrollto {{ request()->routeIs('portfolio') ? 'active':'' }}" href="{{ route('portfolio') }}">Portfolio</a>
          </li>
          <li><a class="nav-link scrollto {{ request()->routeIs('team') ? 'active':'' }}" href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Categories</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              @if(!empty($categories))
              @foreach($categories as $cat)
              <li> <a href="{{ route('category.articles',['slug' => $cat->slug]) }}">{{ $cat->name }}</a> </li>
              @endforeach
              @endif
            </ul>
          </li>
          <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li><a class="getstarted scrollto" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @endif

                            @if (Route::has('register'))
                                <li><a class="getstarted scrollto" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Welcome {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @can('isVisitor')
                                    <a class="dropdown-item" href="{{route('visitor.change.password')}}">Change Password</a>
                                    <a class="dropdown-item" href="{{route('visitor.profile')}}">Profile</a>
                                    @endcan
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->