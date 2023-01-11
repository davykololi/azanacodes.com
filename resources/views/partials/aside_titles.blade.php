@if(!empty($category))
	<h3 class="sidebar-title">{{ $category->name }} Articles</h3>
@elseif(!empty($tag))
	<h3 class="sidebar-title">{{ $tag->name }} Articles</h3>
@elseif(!empty($author))
	<h3 class="sidebar-title">{{ $author->name }} Articles</h3>
@elseif(!empty($article))
	<h3 class="sidebar-title">{{ $article->category->name }} Articles</h3>
@endif