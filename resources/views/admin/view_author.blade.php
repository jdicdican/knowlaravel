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
                <div class="panel-heading">Author's Info</div>
                <div class="panel-body">
                    <div>ID: {{$author['id']}}</div>
                    <div>Fist Name: {{$author['user_detail']['firstname']}}</div>
                    <div>Last Name: {{$author['user_detail']['lastname']}}</div>
                    <a href="{{ route('authors.index') }}"><button class="btn btn-primary btn-sm">Go Back To List</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
