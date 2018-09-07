<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card" style="margin: 1rem 0;">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">By {{ $article->author->email }}</h6>
            <p class="card-text">{{ substr($article->body, 0, 100) }}...</p>
            <a class="btn btn-outline-primary btn-sm" href="{{ route('view-article', ['id' => $article->id]) }}" target="_blank">View</a>
        </div>
        <div class="card-footer">
            <small class="muted">{{ $article->likers_count }} likes</small>
        </div>
    </div>
</div>