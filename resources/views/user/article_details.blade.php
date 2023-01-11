@extends('layouts.app')
    
@section('content')
<main id="main">
  @if($article)
  @section('breadcrumbs')
   <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/article/',['slug'=>$article->slug])}}">{{ Breadcrumbs::render('article.details',$article) }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
  @endsection
    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">
            <article class="entry entry-single">
              <div class="entry-img">
                <img src="{{ $article->imageUrl() }}" alt="{{ $article->title }}" class="img-fluid">
              </div>
              <h1 class="entry-title">
                <a href="{{ $article->path() }}">{{ $article->title }}</a>
              </h1>
              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> 
                    <a href="{{ $article->user->path() }}">{{ $article->user->name }}</a>
                  </li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                    <a href="{{ $article->path() }}">
                      <time datetime="{{ $article->created_at }}">{{ $article->published_at }}</time>
                    </a>
                  </li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> 
                    <a href="{{ $article->path() }}">
                      @if($article->comments->count() <= 1)
                       {{ $article->comments->count() }} Comment
                      @else
                       {{ $article->comments->count() }} Comments
                      @endif
                    </a>
                  </li>
                </ul>
              </div>
              <div class="entry-content">
                <p>{!! $article->content !!}</p>
              </div>
              <div class="entry-footer">
                <i class="bi bi-folder"></i>
                <ul class="cats">
                  <li><a href="#">Business</a></li>
                </ul>

                <i class="bi bi-tags"></i>
                <ul class="tags">
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>
              </div>

              <div class="container mt-4 text-center " loading="lazy">
                <h5><b>Share On:</b></h5>
                {!! $shareComponent !!}
              </div><!-- End Social Media Share -->
              
            </article><!-- End blog entry -->
            <div class="blog-author d-flex align-items-center">
              @if(!empty($article->user->profile))
              <img src="/storage/avatars/{{ $article->user->profile->image }}" class="rounded-circle float-left" alt="{{ $article->user->name }}" loading="lazy">
              <div>
                <h4>By <a href="{{ $article->user->path() }}">{{ $article->user->name }}</a><h4>
                <div class="social-links">
                  <a href="{{ $article->user->profile->twitter_url }}" target="_blank"><i class="bi bi-twitter"></i></a>
                  <a href="{{ $article->user->profile->facebook_url }}" target="_blank"><i class="bi bi-facebook"></i></a>
                  <a href="{{ $article->user->profile->instagram_url }}" target="_blank"><i class="biu bi-instagram"></i></a>
                </div>
                <p>{!! $article->user->profile->user_details!!}</p>
              </div>
              @else
              <img src="{{ asset('/static/avatar.png') }}" class="rounded-circle float-left" alt="default user avatar" loading="lazy">
              <div>
                <h4>By <a href="{{ $article->user->path() }}">{{ $article->user->name }}</a><h4>
                <div class="social-links">
                  <a href="#" target="_blank"><i class="bi bi-twitter"></i></a>
                  <a href="#" target="_blank"><i class="bi bi-facebook"></i></a>
                  <a href="#" target="_blank"><i class="biu bi-instagram"></i></a>
                </div>
                <p>
                  vvvvv
                </p>
              </div>
              @endif
            </div><!-- End blog author bio -->

            <div class="blog-comments">
              <h4 class="comments-count">
                @if($article->comments->count() <= 1)
                  {{ $article->comments->count() }} {{ __('Comment') }}
                @else
                  {{ $article->comments->count() }} {{ __('Comments') }}
                @endif
              </h4>
              @foreach($article->comments as $comment)
              @if(!empty($comment->user->profile))
              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img">
                    <img src="/storage/avatars/{{ $article->user->profile->image }}" alt="{{ $comment->user->name }}" loading="lazy">
                  </div>
                  <div>
                    <h5><a href="">{{ $comment->user->name }}</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                    <time datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('D, M d, Y h:i A') }}</time>
                    <p>{{ $comment->content }}</p>
                  </div>
                </div>
              </div><!-- End comment #1 -->
              @else
              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img">
                    <img src="" onerror="this.src='{{ asset('/static/avatar.png') }}'" alt="{{ $comment->user->name }}" loading="lazy">
                  </div>
                  <div>
                    <h5><a href="">{{ $comment->user->name }}</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                    <time datetime="{{ $comment->created_at }}">{{ $comment->created_at->format('D, M d, Y h:i A') }}</time>
                    <p>{{ $comment->content }}</p>
                  </div>
                </div>
              </div><!-- End comment #1 -->
              @endif
              @endforeach
              <div class="reply-form">
                <h4>Leave a Comment</h4>
                @guest
                <p>Please <a href="{{ url('login') }}"><b>login</b></a> and leave your comment.We value your feedback.</p>
                @endguest

                @auth
                <p>Thank you for logging in <b>{{ Auth::user()->name }}</b>. You can now comment!</p>

                <form method="post" action="{{ route('store.comment') }}">
                  @csrf
                  <div class="row">
                    <div class="col form-group">
                      <input type="hidden" name="article_id" value="{{ $article->id }}">
                      <textarea name="content" class="form-control" placeholder="Your Comment*"></textarea>
                      @error('content')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
                @endauth
              </div>
            </div><!-- End blog comments -->
          </div><!-- End blog entries list -->
          @include('partials.frontend_sidebar')
        </div>
      </div>
    </section><!-- End Blog Single Section -->
    @include('laravel_tutorials')<!-- Laravel Tutorials -->
    @include('reactjs_tutorials')<!-- React js Tutorials -->
    @include('tailwindcss_tutorials')<!-- Tailwind css Tutorials -->
    @include('vuejs_tutorials')<!-- Vue Js Tutorials -->
    @include('all_articles')<!-- Recent Articles -->
    @endif
  </main><!-- End #main -->
@endsection
