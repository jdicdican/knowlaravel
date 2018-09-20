@extends('layouts.templates.full-page')

@section('main-content')
<div class="d-flex justify-content-center">
    <div class="card" style="margin: 1rem 0;">
        <div class="card-body">
            <h5 class="card-title"><span class="oi oi-person" title="Profile" aria-hidden="true"></span> {{ $user->username }}'s Profile</h5>
            <form action="{{ $url = route('update-profile', ['id' => auth()->user()->id]) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <i>Username:</i> <input type="text" name="username" value="{{ $user->username }}"><br>
                <i>First name:</i> <input type="text" name="firstname" value="{{ $user->userDetail->firstname }}"><br>
                <i>Last name:</i> <input type="text" name="lastname" value="{{ $user->userDetail->lastname }}"><br>
                <i>Email:</i> <input type="text" name="email" value="{{ $user->email }}"><br>
                <input class="btn btn-success btn-sm" type="submit" name="edit" value="Update">
            </form>
        </div>
    </div>
</div>
@endsection
