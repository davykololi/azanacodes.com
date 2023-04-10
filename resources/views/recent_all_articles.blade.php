		    <div class="col-lg-4">
            <div class="post-box">
              <div class="post-img">
                <img src="{{ $article->imageUrl() }}" class="img-fluid" alt="{{ $article->title }}" loading="lazy">
              </div>
              <span class="post-date">{{ $article->created_date }}</span>
              <h3 class="post-title">{{ $article->title }}</h3>
              <a href="{{ $article->path() }}" class="readmore stretched-link mt-auto"><span>Read More</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
        </div>