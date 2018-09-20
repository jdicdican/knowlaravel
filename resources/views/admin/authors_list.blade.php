@extends('layouts.templates.full-page')
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
    tr:first-child td{
        padding-right: 10px;
    }
</style>
@section('main-content')
    <div class="container">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Author's List</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>User ID</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($authors as $author)
                        <tr>
                            <td><a href="{{ route('authors.view', ['id' => $author['id']]) }}">{{$author['id']}}</a></td>
                            <td><a href="{{ route('authors.view', ['id' => $author['id']]) }}">{{$author['user_detail']['firstname']}}</a></td>
                            <td><a href="{{ route('authors.view', ['id' => $author['id']]) }}">{{$author['user_detail']['lastname']}}</a></td>
                            <td><a href="{{ route('authors.edit', ['id' => $author['id']]) }}" class="btn btn-success btn-sm">Edit</a></td>
                            <td><a href="{{ route('authors.confirm_delete', ['id' => $author['id']]) }}" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                        @endforeach
                    </table>
                 </div>
            </div>
        </div>
    </div>
@endsection
