@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-success" role="alert">
        Sucessfully Deleted Data!
    </div>
    <a href="{{ route('authors.index') }}">
        <button class="btn btn-primary btn-sm">Go back to List</button>
    </a>
</div>
@endsection
