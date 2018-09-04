@extends('layouts.left-sided-page')

@section('navigation')
    @include('layouts.navbar')
@endsection

@section('sidebar')
    @include('layouts.author-dashboard-sidebar')
@endsection

@section('main-content')    
    <div class="row">
        @foreach ($articles as $article)
            @include("articles.item", ["article" => $article])
        @endforeach
    </div>
@endsection