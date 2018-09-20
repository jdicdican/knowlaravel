<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id) // Tords, maybe put user id as argument. if walay argument, then profile sa user... just a suggestion
    {
        // Tords, insert view code here
       $user = User::find($id);
       return view('layouts.profile', [
            'user' => $user
        ]);

       // dd($user);
    }
}
