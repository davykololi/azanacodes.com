@if(!empty($category) && \Request::is('category/*'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','category.articles',$category)}}
@endif

@if(!empty($tag))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','tag.articles',$tag)}}
@endif

@if(!empty($author))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','articleBy.articles',$author)}}
@endif

@if(!empty($article) && ($title !== 'Home'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','article.details',$article)}}
@endif

@if(\Request::is('/'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','home')}}
@endif

@if(\Request::is('about'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','about')}}
@endif

@if(\Request::is('contact'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','contact')}}
@endif

@if(\Request::is('portfolio'))
	{{ Breadcrumbs::view('breadcrumbs::json-ld','portfolio')}}
@endif

