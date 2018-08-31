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
        $this->middleware('auth');
    }

    /**
     * Redirects from the home url to the appropriate dashboard url
     * depending on the user's user_type
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function redirectToAppropriateRoute()
    {
        session(['user' => \Auth::user()]);
        
        switch (\Auth::user()->user_type) {
            case User::ADMIN:
                // return redirect()->route('route-to-admin-dashboard');
                break;
            case User::AUTHOR:
            case User::REGULAR:
                return redirect()->route('articles');
                break;
        }
    }
}
