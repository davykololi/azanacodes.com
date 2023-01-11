    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h2>Blog</h2>
          <p>Blog Tutorials</p>
        </header>
        <div class="row">
          @if(($allArticles != null) && count($allArticles) > 0)
          @foreach($allArticles as $article)
            @include('recent_all_articles')
          @endforeach
          @endif
        </div>
      </div>
    </section><!-- End Recent Blog Posts Section -->