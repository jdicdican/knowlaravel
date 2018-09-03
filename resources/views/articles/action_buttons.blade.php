<div class="btn-group btn-group-xs" role="group">
    @if($article->published_at != NULL)
        <a href="{{route('like-article', $article->id)}}" class="btn {{ ((Auth::user()->articlesLiked->contains($article->id)) ? 'btn-danger' : 'btn-default') }}">
            {{ $article->likers_count }} LIKE
        </a>
        <a href="#" class="btn btn-default">BOOKMARK</a>
    @endif

    @if(Auth::user()->articles->contains($article->id))
        @if($article->published_at == NULL)
            <a href="{{route('update-article', $article->id)}}" class="btn btn-default">UPDATE</a>
        @endif
        <a href="{{route('delete-article', $article->id)}}" class="btn btn-default">DELETE</a>
    @endif
</div>
