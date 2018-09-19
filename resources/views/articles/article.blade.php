@extends('layouts.templates.full-page')

@section('main-content')
    <input id="article_id" name="article_id" type="hidden" value="{{ $article->id }}" />

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md">
            @if(!Auth::guest())
                @if(Auth::user()->articles->contains($article->id))
                    <div class="btn-group btn-group-sm float-right mt-3" role="group">
                        <a href="{{route('update-article', $article->id)}}" class="btn btn-outline-success">
                            <span class="oi oi-pencil" title="Edit" aria-hidden="true"></span>
                        </a>
                        <button id="delete" class="btn btn-outline-danger">
                            <span class="oi oi-trash" title="Delete" aria-hidden="true"></span>
                        </button>
                    </div>
                @endif
            @endif

            <h1 class="mt-1">{{ $article->title }}</h1>

            <h6>By {{ $article->author->email }}</h6>
            <p class="text-justify">{{ $article->body }}</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md">
            @if(!Auth::guest())
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button id="submit-like" class="btn {{ ((Auth::user()->articlesLiked->contains($article->id)) ? 'btn-outline-danger' : 'btn-outline-secondary') }}">
                            <span class="oi oi-heart" title="Like" aria-hidden="true"></span> {{ $article->likers->count() }}
                        </button>
                    </div>
                    <input id="comment" name="comment"  type="text" class="form-control" placeholder="Write comment...">
                    <div class="input-group-append">
                        <button id="submit-comment" class="btn btn-outline-primary btn-sm">
                            <span class="oi oi-comment-square" title="Comment" aria-hidden="true"></span> Comment
                        </button>
                    </div>
                </div>
            @endif

            <ul class="list-group">
                @foreach($article->comments()->orderBy('id', 'desc')->get() as $comment)
                    <li class="list-group-item disabled">
                        <span><span class="text-primary font-weight-bold">{{ $comment->writer->email }}</span> {{ $comment->body }} <i>{{ $comment->time_elapse() }}</i></span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
