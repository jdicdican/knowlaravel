@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @yield('sidebar')
        </div>
        <div class="col-md-8">
            @yield('mainbar')
        </div>
    </div>
</div>
@endsection
