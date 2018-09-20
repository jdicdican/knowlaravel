@extends('layouts.templates.full-page')
@section('main-content')
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
    <div class="container">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Author's Info</div>
                <div class="panel-body">
                <div style="display: none;">ID: {{$author['id']}}</div>
                    <table class="table">
                        <tr>
                            <td><h4>Name: {{$author->userDetail->firstname}} {{$author->userDetail->lastname}}</h4></td>
                            <td>
                                <a href="{{ route('authors.edit', ['id' => $author['id']]) }}" class="btn btn-success btn-sm">Edit</a>
                                <a href="{{ route('authors.confirm_delete', ['id' => $author['id']]) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>Created</td>
                            <td>Status</td>
                        </tr>
                        @foreach ($articles as $article)
                        <tr>
                            <td>{{$article->title}}</td>
                            <td>{{$article->created_at}}</td>
                            <td>{{$article->published_at ? 'Published':'Draft'}}</td>
                        </tr>
                        @endforeach
                            <td></td>
                            <td></td>
                            <td><a href="{{ route('author.articles', ['id' => $author['id']]) }}" class="btn btn-default btn-sm">View More</a></td>
                    </table>
                    <a href="{{ route('authors.index') }}"><button class="btn btn-primary btn-sm">BACK</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
