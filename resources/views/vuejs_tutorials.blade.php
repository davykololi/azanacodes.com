    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h2>{{ $vueJs->name }}</h2>
          <p>{{ $vueJs->name }} Tutorials</p>
        </header>
        <div class="row">
          @if(!empty($vueJsArticles))
            @forelse($vueJsArticles as $article)
              @include('recent_all_articles')
            @empty
              <p class="text-danger">
                <b>Sorry esteemed reader!, We are yet to publish 
                <span style="color: blue"><a href="{!!$vueJs->path() !!}">{{ $vueJs->name }}</a></span> 
                tutorials. Stay tuned and keep in touch. We value your readership. Scroll down for the latest tutorials. Thank you.</b>
              </p>
            @endforelse
          @endif
        </div>
      </div>
    </section><!-- End Recent Blog Posts Section -->