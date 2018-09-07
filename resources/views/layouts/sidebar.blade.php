<div class="panel panel-default">
    <div class="panel-heading">Navigation</div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li class="{{ ($active == 'dashboard') ? 'active' : '' }}"><a href="{{route('index')}}">Home</a></li>

            @if(session('user')['user_type'] == 2)
                <li class="{{ ($active == 'published') ? 'active' : '' }}"><a href="{{route('published')}}">Blog Posts</a></li>
            @endif
            <li class="{{ ($active == 'bookmarks') ? 'active' : '' }}"><a href="{{route('bookmarks.list')}}">Bookmarks</a></li>
        </ul>
        <br/>
        @if(session('user')['user_type'] == 2)
            <a href="{{route('create-article')}}" class="btn btn-default btn-sm">ADD POST</a>
        @endif
    </div>
</div>
