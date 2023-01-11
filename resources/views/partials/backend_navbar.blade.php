        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('static/logo.png')}}" style="border-radius: 50%;margin: 2px" width="30" height="30">
                    <span style="text-transform: uppercase;">{{ config('app.name') }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @can('isAdmin')
                        <li @if (Request::is('admin/editors*'))  class="nav-item active" @endif>
                            <a class="nav-link" href="{{route('admin.editors.index')}}">EDITORS</a>
                        </li>
                        <li @if (Request::is('admin/authors*')) class="nav-item active" @endif>
                            <a class="nav-link" href="{{route('admin.authors.index')}}">AUTHORS</a>
                        </li>
                        <li @if (Request::is('admin/front-end-users*')) class="nav-item active" @endif>
                            <a class="nav-link" href="{{route('admin.frontendusers')}}">USERS</a>
                        </li>
                        <li @if (Request::is('admin/categories*')) class="nav-item active" @endif>
                            <a class="nav-link" href="{{route('admin.categories.index')}}">CATEGORIES</a>
                        </li>
                        <li @if (Request::is('admin/tags*')) class="nav-item active" @endif>
                            <a class="nav-link" href="{{route('admin.tags.index')}}">TAGS</a>
                        </li>
                        @endcan

                        @can('isAuthor')
                        @if(session('impersonated_by'))
                        @impersonating($guard = null)
                        <li @if (Request::is('author/impersonate-leave*')) class="nav-item active" @endif>
                            <a class="nav-link" href="{{route('author.impersonate-leave')}}">BACK TO MY ACCOUNT</a>
                        </li>
                        @endImpersonating
                        @endif
                        <li @if (Request::is('author/articles*')) class="nav-item active" @endif>
                            <a class="nav-link" href="{{route('author.articles.index')}}">ARTICLES</a>
                        </li>
                        @endcan

                        @can('isEditor')
                        @if(session('impersonated_by'))
                        <li @if (Request::is('editor/impersonate-leave*')) class="nav-item active" @endif>
                            <a class="nav-link" href="{{route('editor.impersonate-leave')}}">BACK TO MY ACCOUNT</a>
                        </li>
                        @endif
                        <li @if (Request::is('editor/articles*')) class="nav-item active" @endif>
                            <a class="nav-link" href="{{route('editor.articles.index')}}">ARTICLES</a>
                        </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
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
                                    <img width="30" height="30" class="rounded-circle" src=""  style="margin: 6px;margin-top: 0px;margin-bottom: 0px">
                                        <span>Welcome: {{ Auth::user()->name }}</span>
                                        <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>