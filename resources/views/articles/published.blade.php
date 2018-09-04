@extends('layouts.full-page')

@section('navigation')
    @include('layouts.navbar')
@endsection

@section('main-content')
    <div class="row justify-content-center">
        <div class="col-md-9">
        <div class="row">
            <div class="col-lg">
                <form class="mt-3">
                    <div class="input-group mb-3">
                        <select class="custom-select" id="sort_by" name="sort_by">
                            @foreach(['Most Recent' => 'published_at', 'Most Popular' => 'likers_count'] as $label => $val)
                                <option value="{{ $val }}" {{ $c_sort_by == $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        <select class="custom-select" id="paginator" name="items_per_page">
                            @foreach([5,6,7,8,9,10] as $val)
                                <option value="{{ $val }}" {{ $c_paginate == $val ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="paginator">Items per page</label>
                        </div>
                    </div>
                </form>
                {{ $c_articles->links() }}
            </div>
        </div>
        <div class="row">
            @foreach ($c_articles as $article)
                @include("articles.item", ["article" => $article])
            @endforeach
        </div>
    </div>

@endsection