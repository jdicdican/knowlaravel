<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $guarded = ['_token'];

    public function login()
    {
        session(['user' => NULL]);
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $post_username = $request->input('username');
        $post_password = $request->input('password');

        $user = User::select('id', 'username', 'password', 'user_type')
                        ->where('username', $post_username)
                        ->first();

        if(Hash::check($post_password, $user['password'])) {
            session(['user' => $user]); // create the session variable
            return redirect('/');
        } else {
            abort(401);
        }
    }
}
