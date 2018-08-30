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
        session(['user' => Auth::user()]);
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin');
        } else {
            $count = $request->get('items_per_page', 5);
            $articles = Article::published()->orderBy('published_at', 'desc')->paginate($count);
            $articles->withPath('dashboard?items_per_page='.$count);
            return view('home', [
                'articles' => $articles,
                'items_per_page' => $count,
                'type' => 'dashboard'
            ]);
        }
    }

    public function mostLiked(Request $request)
    {
        $count = $request->get('items_per_page', 5);
        $articles = Article::withCount('likers')->orderBy('likers_count', 'desc')->paginate($count);
        $articles->withPath('most_liked?items_per_page='.$count);
        session(['user' => Auth::user()]);
        return view('home', [
            'articles' => $articles,
            'items_per_page' => $count,
            'type' => 'most_liked'
        ]);
    }

    public function redirectToIndex()
    {
        return redirect()->route('dashboard');
    }
}
