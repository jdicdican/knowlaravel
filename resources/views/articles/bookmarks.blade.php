@extends('layouts.container')
<?php
    $user_type = session('user')['user_type'];
    $user = session('user')['username'];
    $user_mode = ($user_type == 1 ? 'Admin' : ($user_type == 2 ? 'Author' : 'Regular'));
?>

@section('sidebar')
    @include('layouts.sidebar', ["active" => "bookmarks"])
@endsection

@section('mainbar')
    <div class="panel panel-default">
        <div class="panel-heading">Bookmarks of <span style="text-transform: capitalize;">{{ $user }}</span></div>
            <div class="panel-body">
                <ul class="nav nav-tabs nav-justified">
                    <li class="{{ $type == 'bookmarks' ? 'active' : '' }}"><a href="{{route('bookmarks.list')}}">All Bookmarks</a></li>
                </ul>

                <br>

                <div class="row">
                    <div class="col-lg-4">
                        <form>
                            <div class="input-group">
                                <span class="input-group-addon" for="paginator">Items per page</span>
                                <select class="form-control" id="paginator" name="items_per_page">

                                        <option value="selected">5</option>

                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                {{ $bookmarks->links() }}
                <ul class="list-group">
                    <li class="list-group-item">
                        @foreach ( $bookmarks as $bookmark )
                        <a href="{{route('article.view', ['id'=>$bookmark['id']])}}"><h4>{{$bookmark->title}}</h4></a>
                        <p>{{ str_limit($bookmark->body, 50, '...')}}</p>
                        @endforeach
                    </li>
                </ul>

            </div>
        </div>
    </div>
@endsection
