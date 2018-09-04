@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            @yield('sidebar')
        </div>
        <div class="col-md-10">
            @yield('mainbar')
        </div>
    </div>
</div>
@endsection
