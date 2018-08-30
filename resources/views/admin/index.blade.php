@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Admin</div>
                <div class="panel-body">
                    @include('layouts.dashboard')
                    <a href="{{ $url = route('authors.index') }}">Authors</a>
                </div>
            </div>
        </div>
    </div>
@endsection
