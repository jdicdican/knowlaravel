@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @include('layouts.sidebar', ["active" => "dashboard"])
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @include('layouts.dashboard')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
