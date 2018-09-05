@extends('layouts.templates.left-sided-page')

@section('sidebar')
    {!!html_entity_decode($sidebar)!!}
@endsection

@section('main-content')
    <div class="row">
        <div class="col-12">
            @include('layouts.pagination')
            {{ $articles->links('vendor.pagination.bootstrap-4') }}
        </div>    

        @foreach($articles as $article)
            @include("articles.item")
        @endforeach
    </div>
@endsection