@extends('layouts.container')
<?php
    $user_type = session('user')['user_type'];
    $user_mode = ($user_type == 1 ? 'Admin' : ($user_type == 2 ? 'Author' : 'Regular'));
?>

@section('sidebar')
    @include('layouts.sidebar', ["active" => "dashboard"])
@endsection

@section('mainbar')
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard / {{ $user_mode }}</div>

        <div class="panel-body">
            <ul class="nav nav-tabs nav-justified">
                <li class="{{ $type == 'all' ? 'active' : '' }}"><a href="{{route('articles')}}">All</a></li>
                <li class="{{ $type == 'most_liked' ? 'active' : '' }}"><a href="{{route('most_liked')}}">Most Liked</a></li>
            </ul>

            <br/>

            <div class="row">
                <div class="col-lg-4">
                    <form>
                        <div class="input-group">
                            <span class="input-group-addon" for="paginator">Items per page</span>
                            <select class="form-control" id="paginator" name="items_per_page">
                                @foreach([5,6,7,8,9,10] as $val)
                                    <option value="{{ $val }}" {{ $items_per_page == $val ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            {{ $articles->links() }}
            <ul class="list-group">
                @foreach ($articles as $article)
                    @include("articles.item", ["article" => $article])
                @endforeach
            </ul>
            {{ $articles->links() }}
        </div>
    </div>
@endsection