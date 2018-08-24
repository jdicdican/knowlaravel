<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class DashboardController extends Controller
{
    public function published() {
        \Auth::user()->user_type != 2 ? abort(403) : '';

        return view('articles.published', ['articles' => \Auth::user()->articles()->get()->sortByDesc('id')]);
    }
}
