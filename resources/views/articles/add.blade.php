@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @include('layouts.sidebar', ["active" => ""])
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Create or Modify Post</div>

                <div class="panel-body">
                    <form method="POST" action="{{ route('save-article') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea id="body" name="body" class="form-control" rows="7" required></textarea>
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
