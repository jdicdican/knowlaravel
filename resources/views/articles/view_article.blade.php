@extends('layouts.container')
<?php
    $user_type = session('user')['user_type'];
    $user_mode = ($user_type == 1 ? 'Admin' : ($user_type == 2 ? 'Author' : 'Regular'));
?>

@section('sidebar')
    @include('layouts.sidebar', ["active" => "bookmarks"])
@endsection

@section('mainbar')
    <div class="panel panel-default">
        <div class="panel-heading">View Article</div>
            <div class="panel-body">
                <ul class="nav nav-tabs nav-justified">
                    <li class="{{ $type == 'bookmarks' ? 'active' : '' }}">Posted by <span style="text-transform: capitalize;">{{$article->author->username}} on {{$article->created_at->format('Y-m-d')}}<span></li>
                </ul>

                <br/>

                <ul class="list-group">
                    <h4>{{$article->title}}</h4>
                    <p>{{$article->body}}</p>
                </ul>

                <a href="{{route('like-article', $article->id)}}" class="btn {{ ((Auth::user()->articlesLiked->contains($article->id)) ? 'btn-danger' : 'btn-default') }}">{{ $article->likers->count() }} LIKE </a>
                <a href="{{route('bookmark', $article->id)}}" class="btn {{ ((Auth::user()->bookmark->contains($article->id)) ? 'btn-danger' : 'btn-default') }}">BOOKMARK</a>
                <a href="{{route('bookmarks.list')}}" class="btn {{ ((Auth::user()->bookmark->contains($article->id)) ? 'btn-primary' : 'btn-default') }}">BACK</a>

        </div>
    </div>
@endsection

