<li class="list-group-item">
    <h4>{{$article['title']}}</h4>
    <p>{{$article['body']}}</p>
    <div class="btn-group btn-group-xs" role="group">
        <a href="{{route('like-article', $article['id'])}}" class="btn {{ session('user')->articlesLiked->contains($article['id']) ? 'btn-danger' : 'btn-default' }}">
            {{ (isset($article->likers_count) ? $article->likers_count : '') }} LIKE
        </a>
        @if($article->author->id == session('user')['id'])
            <a href="{{route('update-article', $article['id'])}}" class="btn btn-default">UPDATE</a>
            <a href="{{route('delete-article', $article['id'])}}" class="btn btn-default">DELETE</a>
        @endif
    </div>
</li>