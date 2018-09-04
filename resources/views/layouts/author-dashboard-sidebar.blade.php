<nav class="nav nav-pills flex-column mt-3">
    <a class="nav-link {{ ((route('published') == url()->current()) ? 'active' : '') }}" href="{{ route('published') }}">Published</a>
    <a class="nav-link {{ ((route('drafts') == url()->current()) ? 'active' : '') }}" href="{{ route('drafts') }}">Drafts</a>
    @if( route('create-article') == url()->current() )
        <a class="nav-link active" href="{{ route('create-article') }}">Write Post</a>
    @elseif( route('update-article', ['id' => @$article->id ?: 0]) == url()->current() )
        <a class="nav-link active" href="{{ route('create-article') }}">Update Post</a>
    @else
        <a class="nav-link" href="{{ route('create-article') }}">Write Post</a>
    @endif
</nav>