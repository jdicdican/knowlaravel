<script language='javascript'>
    $(function(){
        $('#paginator').bind('change', function () {
            var url = '/dashboard/?items_per_page='+$(this).val();
            if (url) {
                window.location = url; 
            }
            return false;
        });
    });
</script>

<ul class="nav nav-tabs nav-justified">
    <li class="{{ $type == 'dashboard' ? 'active' : '' }}"><a href="{{route('dashboard')}}">All</a></li>
    <li class="{{ $type == 'most_liked' ? 'active' : '' }}"><a href="{{route('most_liked')}}">Most Liked</a></li>
</ul>

<div class="row">
    <div class="col-lg-4">
        <form method="GET" action="{{ route('dashboard') }}">
        <div class="form-group">
            <label for="paginator">Items per page</label>
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
        @include("articles.article_item", ["article" => $article])
    @endforeach
</ul>
{{ $articles->links() }}