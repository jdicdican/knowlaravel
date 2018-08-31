@extends('layouts.container')

@section('sidebar')
    @include('layouts.sidebar', ["active" => "published"])
@endsection

@section('mainbar')
    <div class="panel panel-default">
        <div class="panel-heading">Your Posts</div>

        <div class="panel-body">
            <ul class="nav nav-tabs nav-justified">
                <li class="{{ $type == 'published' ? 'active' : '' }}"><a href="{{route('published')}}">Published</a></li>
                <li class="{{ $type == 'drafts' ? 'active' : '' }}"><a href="{{route('drafts')}}">Drafts</a></li>
            </ul>

            <ul class="list-group">
                @foreach($articles as $article)
                    @include("articles.item", ["article" => $article])
                @endforeach
            </ul>
        </div>
    </div>
@endsection
