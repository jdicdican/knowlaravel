<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Redirects from the home url to the appropriate dashboard url
     * depending on the user's user_type
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function redirectToAppropriateRoute()
    {
        if(\Auth::guest()) {
            return redirect()->route('home', ['type' => 'all']);
        } else {
            switch (\Auth::user()->user_type) {
                case User::ADMIN:
                    return redirect()->route('admin');
                    break;
                case User::AUTHOR:
                    return redirect()->route('author-dashboard', ['type' => 'my']);
                    break;
                case User::REGULAR:
                    return redirect()->route('home', ['type' => 'all']);
                    break;
            }
        }
        session(['user' => \Auth::user()]);
    }
}
