<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {
        $count = isset($request['items_per_page']) ? $request['items_per_page'] : 5;
        $articles = Article::whereNotNull('published_at')->orderBy('published_at', 'desc')->paginate($count);
        $articles->withPath('dashboard?items_per_page='.$count);
        session(['user' => Auth::user()]);
        return view('home', [
            'articles' => $articles,
            'items_per_page' => $count
        ]);
            // 'allArticles' => Article::whereNotNull('published_at')->get()->sortByDesc('id')]);
    }

    public function redirectToIndex()
    {
        return redirect()->route('dashboard');
    }
}
