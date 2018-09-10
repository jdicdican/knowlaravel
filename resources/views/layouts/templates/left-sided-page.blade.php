@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2">@yield('sidebar')</div>
        <div class="col-md-10">@yield('main-content')</div>
    </div>
@endsection