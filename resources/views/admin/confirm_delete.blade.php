@extends('layouts.app')
<style type="text/css">
    .author {
        display: block;
    }
    a, form, input {
        display: inline-block;;
    }
    a:link {
        text-decoration: none;
    }
</style>
@section('content')
    <div class="container">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Confirm Delete</div>
                <div class="panel-body">
                    <div class="alert alert-primary" role="alert">
                      Are you sure you want to delete Author {{$author['user_detail']['firstname']}} {{$author['user_detail']['lastname']}}?
                    </div>
                    <a href="{{ route('authors.delete', ['id' => $author['id']]) }}">
                        <button class="btn btn-success btn-sm">Yes</button>
                    </a>
                    <a href="{{ route('authors.index') }}">
                        <button class="btn btn-primary btn-sm">Cancel</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
