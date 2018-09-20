@extends('layouts.templates.full-page')

@section('main-content')
<div class="d-flex justify-content-center">
    <div class="card" style="margin: 1rem 0;">
        <div class="card-body">
            <h5 class="card-title"><span class="oi oi-person" title="Profile" aria-hidden="true"></span> {{ $user->username }}</h5>
            <h6 class="card-subtitle mb-2 text-muted"><i>First Name: </i>{{ $user->userDetail->firstname }}</h6>
            <h6 class="card-subtitle mb-2 text-muted"><i>Last Name:  {{ $user->userDetail->lastname }}</i></h6>
            <h6 class="card-subtitle mb-2 text-muted"><i>Email: </i>{{ $user->email }}</h6>
            <h6 class="card-subtitle mb-2 text-muted"><i>UserType: </i>{{ $user->printUserType()}}</h6>
            <a href="#"><button class="btn btn-success btn-sm">Edit</button></a>
        </div>
    </div>
</div>
@endsection
