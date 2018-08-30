@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<?php
    $user_type = session('user')['user_type'];
    $user_mode = ($user_type == 1 ? 'Admin' : ($user_type == 2 ? 'Author' : 'Regular'));
    echo "<p>Welcome ".$user_mode."! You are logged in.</p>";
?>

<!-- Display views/articles/all if user is author or regular all data from
     the ancestor view/s are retained -->
@if (($user_type == 2) || ($user_type == 3))
    @include('articles.all')
@endif
