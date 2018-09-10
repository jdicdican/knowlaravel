<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

class ArticlesNavigationController extends Controller
{
    /**
     * Show the proper view for the author
     *
     * @param Illuminate\Http\Request $request
     * @param string $type
     * @return \Illuminate\Http\Response
     */
    public function author(Request $request, $type)
    {
        $articles = \Auth::user()->articles()->withCount('likers')->orderBy('id', 'desc');
        switch ($type) {
            case "my":
                break;
            case "published":
                $articles = $articles->published();
                break;
            case "drafts":
                $articles = $articles->drafts();
                break;
            default:
                die(404);
                break;
        }

        return view('articles.list', [
            'sidebar' => view('layouts.author-dashboard-sidebar'),
            'articles' => $articles->paginate($request->get('items_per_page', 5))
        ]);
    }

    /**
     * Shows all of the published articles - for all types of users
     *
     * @param Illuminate\Http\Request $request
     * @param string $type
     * @return \Illuminate\Http\Response
     */
    public function everyone(Request $request, $type)
    {
        $articles = Article::withCount('likers');

        switch ($type) {
            case "all":
                $articles = $articles->orderBy('id', 'desc')->published();
                break;
            case "popular":
                $articles = $articles->orderBy('likers_count', 'desc')->published();
                break;
            case 'bookmarks':
                $articles = \Auth::user()->bookmarks()->withCount('likers')->orderBy('id', 'desc');
                break;

            default:
                die(404);
                break;
        }

        $items_per_page = $request->get('items_per_page', 5);

        return view('articles.list', [
            'sidebar' => view('layouts.home-sidebar'),
            'articles' => $articles->paginate($items_per_page)
                        ->withPath(route('home', ['type' => $type])."?items_per_page=".strval($items_per_page))
        ]);
    }
}
