@extends('layouts.templates.full-page')

@section('main-content')
<div class="d-flex justify-content-center">
    <div class="card" style="margin: 1rem 0;">
        <div class="card-body">
            <h5 class="card-title"><span class="oi oi-person" title="Profile" aria-hidden="true"></span> {{ $user->username }}'s Profile</h5>
            <h6 class="card-subtitle mb-2 text-muted"><i>First Name: </i>{{ $user->userDetail->firstname }}</h6>
            <h6 class="card-subtitle mb-2 text-muted"><i>Last Name: </i>{{ $user->userDetail->lastname }}</h6>
            <h6 class="card-subtitle mb-2 text-muted"><i>Email: </i>{{ $user->email }}</h6>
            <h6 class="card-subtitle mb-2 text-muted"><i>User Type: </i>{{ $user->getUserType()}}</h6>
            <a href="{{ route('edit-profile', ['id' => auth()->user()->id]) }}"><button class="btn btn-success btn-sm">Edit</button></a>
        </div>
    </div>
</div>
@endsection
