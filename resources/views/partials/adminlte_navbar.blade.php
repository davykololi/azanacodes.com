<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @can('isAdmin')
      <li @if(\Request::is('admin/editors*')) class="nav-item d-none d-sm-inline-block" @endif>
        <a class="nav-link" href="{{route('admin.editors.index')}}">Editors</a>
      </li>
      <li @if(\Request::is('admin/authors*')) class="nav-item d-none d-sm-inline-block" @endif>
        <a class="nav-link" href="{{route('admin.authors.index')}}">Authors</a>
      </li>
      <li @if(\Request::is('admin/front-end-users*')) class="nav-item d-none d-sm-inline-block" @endif>
        <a class="nav-link" href="{{route('admin.frontendusers')}}">Users</a>
      </li>
      <li @if(\Request::is('admin/categories*')) class="nav-item d-none d-sm-inline-block" @endif>
        <a class="nav-link" href="{{route('admin.categories.index')}}">Categories</a>
      </li>
      <li @if(\Request::is('admin/tags*')) class="nav-item d-none d-sm-inline-block" @endif>  
        <a class="nav-link" href="{{route('admin.tags.index')}}">Tags</a>
      </li>
      @endcan

      @can('isAuthor')
      @if(session('impersonated_by'))
      @impersonating($guard = null)
      <li @if(Request::is('author/impersonate-leave*')) class="nav-item d-none d-sm-inline-block" @endif>
          <a class="nav-link" href="{{route('author.impersonate-leave')}}">Back To My Account</a>
      </li>
      @endImpersonating
      @endif
      <li @if(Request::is('author/articles*')) class="nav-item d-none d-sm-inline-block" @endif>
          <a class="nav-link" href="{{route('author.articles.index')}}">Articles</a>
      </li>
      @endcan

      @can('isEditor')
      @if(session('impersonated_by'))
      <li @if (Request::is('editor/impersonate-leave*')) class="nav-item d-none d-sm-inline-block" @endif>
          <a class="nav-link" href="{{route('editor.impersonate-leave')}}">Back To My Account</a>
      </li>
      @endif
      <li @if (Request::is('editor/articles*')) class="nav-item d-none d-sm-inline-block" @endif>
          <a class="nav-link" href="{{route('editor.articles.index')}}">Articles</a>
      </li>
      @endcan
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
      @if (Route::has('register'))
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
      </li>
      @endif
      @else
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        @if(!empty(Auth::user()->profile) && (\App::environment() === 'local'))
          <img width="30" height="30" class="rounded-circle" src="/storage/avatars/{{ Auth::user()->profile->image }}"  style="margin: 6px;margin-top: 0px;margin-bottom: 0px">
        @elseif(!empty(Auth::user()->profile) && (\App::environment() === 'production'))
          <img width="30" height="30" class="rounded-circle" src="/storage/avatars/{{ Auth::user()->profile->image }}" onerror="this.src='{{ Auth::user()->gravatar() }}'"  style="margin: 6px;margin-top: 0px;margin-bottom: 0px">
        @else
          <img width="30" height="30" class="rounded-circle" src="#" onerror="this.src='{{ asset('static/avatar.png') }}'"  style="margin: 6px;margin-top: 0px;margin-bottom: 0px">
        @endif
          <span>
            @if(Auth::user()->role->value === 'admin')
              {{ __('Superadmin') }}
            @else
              {{ Auth::user()->name }}
            @endif
          </span>
          <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @can('isAuthor')
              <a class="dropdown-item" href="{{route('author.profile.dashboard')}}"><b>Profile</b></a>
            @endcan
            @can('isEditor')
              <a class="dropdown-item" href="{{route('editor.profile.dashboard')}}"><b>Profile</b></a>
            @endcan
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <b>{{ __('Logout') }}</b>
            </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
      @endguest
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->