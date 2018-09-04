@extends('layouts.left-sided-page')

@section('navigation')
    @include('layouts.navbar')
@endsection

@section('sidebar')
    @include('layouts.author-dashboard-sidebar')
@endsection

@section('main-content')
    <h4>{{ $method == 'update' ? 'Modify Post' : 'Create Post' }}</h4>

    <form>
        <div class="form-group">
            <input id="article_id" type="hidden" value="{{ @$article->id ?: '' }}" required />
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" type="text" class="form-control" value="{{ @$article->title ?: '' }}" required />
        </div>

        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="body" class="form-control" rows="7" required>{{ @$article->body ?: '' }}</textarea>
        </div>

        <div class="checkbox">
            <label><input type="checkbox" id="is_draft" value="1"> Draft</label>
        </div>

        <div class="form-group">
            <button id="save" class="btn btn-primary">SAVE</button>
        </div>
    </form>
@endsection
