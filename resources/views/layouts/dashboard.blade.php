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

<div class="row">
    <div class="col-lg-4">
        <form method="GET" action="{{ route('dashboard') }}">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Items Per Page</span>
                    <input type="text" value="{{ isset($items_per_page) ? $items_per_page : 5 }}" class="form-control" id="items_per_page" name="items_per_page">
                    <div class="input-group-btn">
                        <input type="submit" class="btn btn-primary" value="SET"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{ $articles->links() }}
<ul class="list-group">
    @foreach ($articles as $article)
        @include("articles.article_item", ["article" => $article])
    @endforeach
</ul>
{{ $articles->links() }}