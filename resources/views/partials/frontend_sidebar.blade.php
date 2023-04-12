          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form method="GET">
                  <input type="text" name="search" value="{{ request()->get('search')}}">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                  @if(!empty($categories))
                  @foreach($categories as $cat)
                  <li><a href="{!! $cat->path() !!}">{{ $cat->name }} <span>({{ $cat->articles->count() }})</span></a></li>
                  @endforeach
                  @endif
                </ul>
              </div><!-- End sidebar categories-->

              <!-- Sidebar Titles -->
              @if(!request()->routeIs('home'))
                @include('partials.aside_titles')
              @endif
              <!-- End Sidebar Titles -->
              <div class="sidebar-item recent-posts">
                @if(!empty($asides))
                @foreach($asides as $art)
                <div class="post-item clearfix">
                  <img src="{{ $art->imageUrl() }}" alt="{{ $art->title }}" loading="lazy">
                  <h4><a href="{{ $art->path() }}">{{ $art->title }}</a></h4>
                </div>
                @endforeach
                @endif
              </div><!-- End sidebar category articles-->

              <h3 class="sidebar-title"> {{__('Latest Articles') }}</h3>
              <div class="sidebar-item recent-posts">
                @if(!empty($allArticlesAside))
                @foreach($allArticlesAside as $artic)
                <div class="post-item clearfix">
                  <img src="{{ $artic->imageUrl() }}" alt="{{ $artic->title }}" loading="lazy">
                  <h4><a href="{{ $artic->path() }}">{{ $artic->title }}</a></h4>
                </div>
                @endforeach
                @endif
              </div><!-- End sidebar recent articles-->

              <h3 class="sidebar-title">Popular Articles</h3>
              <div class="sidebar-item recent-posts">
                
                <div class="post-item clearfix">
                  <img src="#" alt="#" loading="lazy">
                  <h4><a href="#"></a></h4>
                  <time datetime="#"></time>
                </div>
              </div><!-- End sidebar popular articles-->
              
              <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  @if(!empty($tags))
                  @foreach($tags as $tag)
                  <li><a href="{!! $tag->path() !!}">{{ $tag->name }}</a></li>
                  @endforeach
                  @endif
                </ul>
              </div><!-- End sidebar tags-->
              
            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->