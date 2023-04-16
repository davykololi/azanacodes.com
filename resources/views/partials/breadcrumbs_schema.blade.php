@if(!empty($category) && request()->routeIs('category.articles',['slug'=>$category->slug]))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','category.articles',$category)}}
@endif

@if(!empty($tag) && request()->routeIs('tag.articles',['slug'=>$tag->slug]))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','tag.articles',$tag)}}
@endif

@if(!empty($author) && request()->routeIs('article-author.articles',['slug'=>$author->slug]))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','article-author.articles',$author)}}
@endif

@if(!empty($article) && request()->routeIs('article.details',['slug'=>$article->category->slug]))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','article.details',$article)}}
@endif

@if(request()->routeIs('home'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','home')}}
@endif

@if(!empty($featuredArticles) && request()->routeIs('blog'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','blog')}}
@endif

@if(request()->routeIs('about'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','about')}}
@endif

@if(request()->routeIs('contact'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','contact')}}
@endif

@if(request()->routeIs('portfolio'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','portfolio')}}
@endif

@if(request()->routeIs('policy'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','policy')}}
@endif

@if(request()->routeIs('terms.of.service'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','terms.of.service')}}
@endif

@if(request()->routeIs('services'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','services')}}
@endif

@if(request()->routeIs('seo.service'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','seo.service')}}
@endif

@if(request()->routeIs('webdevpt.service'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','webdevpt.service')}}
@endif

@if(request()->routeIs('team'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','team')}}
@endif
