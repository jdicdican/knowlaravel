<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id) //get user's info using user id
    {
       $user = User::find($id);
       return view('layouts.profile', [
            'user' => $user
        ]);
    }

    public function showEditProfile($id)//show edit_profile page
    {
        $user = User::find($id);
       return view('layouts.edit_profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        $input = $request->all();
        unset($input['_method']);
        unset($input['_token']);
        unset($input['Update']);
        $user = User::find($id);

        // $user->update($input);

        $user->userDetail->update([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname']
        ]);

        $user->update([
            'username' => $input['username'],
            'email' => $input['email']
        ]);

        return redirect()->route('profile', ['id' => $id]);
    }
}
