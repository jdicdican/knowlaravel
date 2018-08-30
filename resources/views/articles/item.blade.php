<li class="list-group-item">
    <h4>{{$article['title']}}</h4>
    <p>{{$article['body']}}</p>

    <!-- Buttons: DRAFT UPDATE DELETE -->
    @include('articles.action_buttons')
</li>