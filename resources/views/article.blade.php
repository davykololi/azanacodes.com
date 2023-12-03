            <article class="entry">
              <div class="entry-img">
                <a href="{!! $article->path() !!}">
                  <img src="{{ $article->imageUrl() }}" alt="{{ $article->title }}" class="img-fluid">
                </a>
              </div>

              <h2 class="entry-title">
                <a href="{{ $article->path() }}">{{ $article->title }}</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> 
                    <a href="{{ $article->user->path() }}">{{ $article->user->name }}</a>
                  </li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                    <a href="{{ $article->path() }}">
                      <time datetime="{{ $article->created_at }}">{{ $article->created_date }}</time>
                    </a>
                  </li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> 
                    <a href="{{ $article->path() }}">{{ $article->comments->count() }} Comments</a>
                  </li>
                  <li class="d-flex align-items-center">
                    Tags:
                    @foreach($article->tags as $tag)
                      <a href="{{ URL::to('/tag',['slug'=>$tag->slug])}}">{{ $tag->name }}</a>
                    @endforeach
                  </li>
                </ul>
              </div>

              <div class="entry-content">
                <p>{!! $article->excerpt() !!} <i><b>{{ $article->reading_time}}</b></i></p>
                <div class="read-more">
                  <a href="{!! $article->path() !!}">Read More <i class="fa fa-eye"></i></a>
                </div>
              </div>
            </article><!-- End blog entry -->