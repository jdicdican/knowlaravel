<li class="list-group-item">
    <h4>{{$article['title']}}</h4>
    <p>{{$article['body']}}</p>

    @if($article->author->id == session('user')['id'])
    <div class="btn-group btn-group-xs" role="group">
        <a href="{{route('update-article', $article['id'])}}" class="btn btn-default">UPDATE</a>
        <a href="{{route('delete-article', $article['id'])}}" class="btn btn-default">DELETE</a>
    </div>
    @endif
    
</li>