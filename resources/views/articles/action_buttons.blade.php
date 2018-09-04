<div class="btn-group btn-group-sm" role="group">
    @if($article->published_at != NULL)
        <a href="{{route('like-article', $article->id)}}" class="btn {{ ((Auth::user()->articlesLiked->contains($article->id)) ? 'btn-outline-danger' : 'btn-outline-secondary') }}">
            <span class="oi oi-heart" title="heart" aria-hidden="true"></span>
            {{ $article->likers->count() }}
        </a>
        <a href="#" class="btn btn-default">BOOKMARK</a>
    @endif

    @if(Auth::user()->articles->contains($article->id))
        <a href="{{route('update-article', $article->id)}}" class="btn btn-outline-secondary">
            <span class="oi oi-pencil" title="pencil" aria-hidden="true"></span>
        </a>
        
        <a href="{{route('delete-article', $article->id)}}" class="btn btn-outline-secondary">
            <span class="oi oi-trash" title="trash" aria-hidden="true"></span>
        </a>
    @endif
</div>
