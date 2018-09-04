@extends('layouts.full-page')

@section('navigation')
    @include('layouts.navbar')
@endsection

@section('main-content')
    <input id="article_id" name="article_id" type="hidden" value="{{ $article->id }}" />

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md">
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

            <h1 class="mt-1">{{ $article->title }}</h1>
            
            <h6>By {{ $article->author->userDetail->firstname }} {{ $article->author->userDetail->lastname }} / {{ $article->author->username }}</h6>
            <p class="text-justify">{{ $article->body }}</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md">
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

            <ul class="list-group">
                @foreach($article->comments()->orderBy('id', 'desc')->get() as $comment)
                    <li class="list-group-item disabled">
                        <span><span class="text-primary font-weight-bold">{{ $comment->writer->username }}</span> {{ $comment->body }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection