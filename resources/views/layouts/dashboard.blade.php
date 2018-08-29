@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

Welcome
@if(session('user')['user_type'] == 1)
    Admin
@elseif(session('user')['user_type'] == 2)
    Author
@endif
!

You are logged in!

<script language='javascript'>
      $(function(){
          // bind change event to select
          $('#paginator').bind('change', function () {
              var url = '/dashboard/?items_per_page='+$(this).val();
              if (url) {
                  window.location = url; 
              }
              return false;
          });
        });
</script>

<div class="row">
    <div class="col-lg-4">
        <form method="GET" action="{{ route('dashboard') }}">
        <div class="form-group">
            <label for="paginator">Items per page</label>
            <select class="form-control" id="paginator" name="items_per_page">
                @foreach([5,6,7,8,9,10] as $val)
                    <option value="{{ $val }}" {{ $items_per_page == $val ? 'selected' : '' }}>{{ $val }}</option>
                @endforeach
<!--                 
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option> -->
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