<nav class="nav nav-pills flex-column mt-3">
    <a class="nav-link {{ ((route('home', ['type' => 'all']) == url()->current()) ? 'active' : '') }}" href="{{ route('home', ['type' => 'all']) }}">All</a>
    <a class="nav-link {{ ((route('home', ['type' => 'popular']) == url()->current()) ? 'active' : '') }}" href="{{ route('home', ['type' => 'popular']) }}">Most Popular</a>
    <a class="nav-link" href="#">Bookmarks</a>
</nav>