<nav class="nav nav-pills flex-column mt-3">
    <a class="nav-link {{ ((route('home', ['type' => 'all']) == url()->current()) ? 'active' : '') }}" href="{{ route('home', ['type' => 'all']) }}">All</a>
    <a class="nav-link {{ ((route('home', ['type' => 'popular']) == url()->current()) ? 'active' : '') }}" href="{{ route('home', ['type' => 'popular']) }}">Most Popular</a>
    @if( !Auth::guest())
        <a class="nav-link {{ ((route('home', ['type' => 'bookmarks']) == url()->current()) ? 'active' : '') }}" href="{{ route('home', ['type' => 'bookmarks']) }}">Bookmarks</a>
    @endif
</nav>
