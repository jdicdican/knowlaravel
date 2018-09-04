<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

class ArticlesNavigationController extends Controller
{
    /**
     * Show all of the published articles
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_by = $request->get('sort_by', 'published_at');
        $paginate = $request->get('items_per_page', 5);

        $articles = Article::published()->withCount('likers')->orderBy($sort_by, 'desc')->paginate($paginate);
        $articles->withPath('home/?items_per_page='.$paginate.'&sort_by='.$sort_by);

        return view('articles.published', [
            'c_articles' => $articles,
            'c_paginate' => $paginate,
            'c_sort_by' => $sort_by
        ]);
    }

    /**
     * Show the articles published by the current user
     *
     * @return \Illuminate\Http\Response
     */
    public function published()
    {
        return view('articles.authored', [
            'type' => 'published',
            'articles' => \Auth::user()->articles()->published()->withCount('likers')->get()->sortByDesc('id')]);
    }

    /**
     * Show the draft articles of the user
     *
     * @return \Illuminate\Http\Response
     */
    public function drafts()
    {
        return view('articles.authored', [
            'type' => 'drafts',
            'articles' => \Auth::user()->articles()->drafts()->get()->sortByDesc('id')]);
    }
}
