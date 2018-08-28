@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @include('layouts.sidebar', ["active" => "published"])
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Your Posts</div>

                <div class="panel-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="{{ $type == 'published' ? 'active' : '' }}"><a href="{{route('published')}}">Published</a></li>
                        <li class="{{ $type == 'drafts' ? 'active' : '' }}"><a href="{{route('drafts')}}">Drafts</a></li>
                    </ul>

                    <ul class="list-group">
                        @foreach($articles as $article)
                            @include("articles.article_item", ["article" => $article])
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
