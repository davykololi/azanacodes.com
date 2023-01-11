    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h2>{{ $reactJs->name }}</h2>
          <p>{{ $reactJs->name }} Tutorials</p>
        </header>
        <div class="row">
          @if(!empty($reactJsArticles))
            @forelse($reactJsArticles as $article)
              @include('recent_all_articles')
            @empty
              <p class="text-danger">
                <b>Sorry esteemed reader!, We are yet to publish 
                <span style="color: blue"><a href="{!! $reactJs->path() !!}">{{ $reactJs->name }}</a></span> 
                tutorials. Stay tuned and keep in touch. We value your readership. Scroll down for the latest tutorials. Thank you.</b>
              </p>
            @endforelse
          @endif
        </div>
      </div>
    </section><!-- End Recent Blog Posts Section -->