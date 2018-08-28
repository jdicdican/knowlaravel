<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class DashboardController extends Controller
{
    public function published() {
        \Auth::user()->user_type != 2 ? abort(403) : '';

        return view('articles.owned', [
            'type' => 'published',
            'articles' => \Auth::user()->articles()->whereNotNull('published_at')->get()->sortByDesc('id')]);
    }

    public function drafts() {
        \Auth::user()->user_type != 2 ? abort(403) : '';

        return view('articles.owned', [
            'type' => 'drafts',
            'articles' => \Auth::user()->articles()->whereNull('published_at')->get()->sortByDesc('id')]);
    }
}
