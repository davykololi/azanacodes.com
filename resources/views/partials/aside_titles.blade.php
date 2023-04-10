@if(request()->routeIs('blog'))
	<h3 class="sidebar-title"></h3>
@elseif(!empty($category) && request()->routeIs('category.articles',['slug'=>$category->slug]))
	<h3 class="sidebar-title">{{ $category->name }} Articles</h3>
@elseif(!empty($tag) && request()->routeIs('tag.articles',['slug'=>$tag->slug]))
	<h3 class="sidebar-title">{{ $tag->name }} Articles</h3>
@elseif(!empty($author) && request()->routeIs('article-author.articles',['slug'=>$author->slug]))
	<h3 class="sidebar-title">{{ $author->name }} Articles</h3>
@elseif(!empty($article) && request()->routeIs('article.details',['slug'=>$article->category->slug]))
	<h3 class="sidebar-title">{{ $article->category->name }} Articles</h3>
@endif