<nav class="nav nav-pills flex-column mt-3">
    <a class="nav-link {{ ((route('author-dashboard', ['type' => 'my']) == url()->current()) ? 'active' : '') }}" href="{{ route('author-dashboard', ['type' => 'my']) }}">All</a>
    <a class="nav-link {{ ((route('author-dashboard', ['type' => 'published']) == url()->current()) ? 'active' : '') }}" href="{{ route('author-dashboard', ['type' => 'published']) }}">Published</a>
    <a class="nav-link {{ ((route('author-dashboard', ['type' => 'drafts']) == url()->current()) ? 'active' : '') }}" href="{{ route('author-dashboard', ['type' => 'drafts']) }}">Drafts</a>
    <a class="nav-link {{ ((route('create-article') == url()->current()) ? 'active' : '') }}" href="{{ route('create-article') }}">Write Post</a>
</nav>
