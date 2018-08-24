<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleSave;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        return $articles;
    }

    public function create()
    {
        \Auth::user()->user_type != 2 ? abort(403) : '';

        return view('articles.add');
    }

    public function save(ArticleSave $request)
    {
        \Auth::user()->user_type != 2 ? abort(403) : '';
        
        \Auth::user()->articles()->create([
            'title' => $request['title'],
            'body' => $request['body']
        ]);

        return redirect()->route('published');
    }
}
