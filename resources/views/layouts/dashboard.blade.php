@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

Welcome
@if(session('user')['user_type'] == 1)
    Admin
@elseif(session('user')['user_type'] == 2)
    Author
@endif
!

You are logged in!

<ul class="list-group">
    @foreach($allArticles as $article)
        @include("articles.article_item", ["article" => $article])
    @endforeach
</ul>