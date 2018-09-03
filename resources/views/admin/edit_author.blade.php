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
                <div class="panel-heading">Edit Author</div>
                <div class="panel-body">
                <form action="{{ $url = route('authors.update', ['id' => $author['id']]) }}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        First name: <input type="text" name="firstname" value="{{$author['user_detail']['firstname']}}"><br>
                        Last name: <input type="text" name="lastname" value="{{$author['user_detail']['lastname']}}"><br><br>
                    <input class="btn btn-success btn-sm" type="submit" name="edit" value="Update">
                    <a href="{{ route('authors.index') }}"><button class="btn btn-primary btn-sm">Cancel</button></a>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
