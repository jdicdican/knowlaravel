@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @include('layouts.sidebar', ["active" => ""])
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $method == 'update' ? 'Modify Post' : 'Create Post' }}
                </div>

                <div class="panel-body">
                    <form method="POST" action="{{ route( 'save-article', ['id'=> isset($id) ? $id : ''] ) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input id="id" name="id" type="hidden" value="{{ isset($id) ? $id : '' }}" required />
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" class="form-control" value="{{ isset($title) ? $title : '' }}" required />
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea id="body" name="body" class="form-control" rows="7" required>{{ isset($body) ? $body : '' }}</textarea>
                        </div>

                        <div class="checkbox">
                            <label><input type="checkbox" name="is_draft" value="1"> Draft</label>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="SAVE" class="btn btn-primary" />
                        </div>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
