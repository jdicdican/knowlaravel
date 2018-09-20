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
    tr td{
        padding: 5px 10px;
    }
</style>
@section('main-content')
    <div class="container">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{$author->userDetail->firstname}}'s Articles</div>
                <div class="panel-body">
                    <div style="display: none;">ID: {{$author['id']}}</div>
                    <table class="table">
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
                            @include('layouts.pagination')
                            {{$articles->links('vendor.pagination.bootstrap-4')}}</td>
                    </table>
                    <a href="{{ route('authors.view', ['id' => $author['id']]) }}"><button class="btn btn-primary btn-sm">BACK</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
