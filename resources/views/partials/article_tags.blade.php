<div class="tags">     
    <strong>Tags:</strong>
    @if(!empty($article->tags))
    @foreach ($article->tags as $tag)
            <a href="{!! $tag->path() !!}">
               <span class="label label-info" style="margin: 5px;display: inline-block;">{!! $tag->name !!}</span>
            </a>
    @endforeach
    @endif
</div>
                          