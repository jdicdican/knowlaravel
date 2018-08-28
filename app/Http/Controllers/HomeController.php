<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['user' => Auth::user()]);
        return view('home', ['allArticles' => Article::whereNotNull('published_at')->get()->sortByDesc('id')]);
    }

    public function redirectIndex()
    {
        return redirect('dashboard');
    }
}
