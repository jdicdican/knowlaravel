<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ((session('user') != NULL) && ($request->session()->has('user'))) {
            return view('dashboard');
        } else {
            return redirect('/user/login');
        }
    }
}
