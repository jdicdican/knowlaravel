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
        return $this->articles('all', 'articles', 'published_at', $request->get('items_per_page', 5));
    }

    /**
     * Show all of the most liked, published articles
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function mostLiked(Request $request)
    {
        return $this->articles('most_liked', 'most_liked', 'likers_count', $request->get('items_per_page', 5));
    }

    /**
     * Returns a view showing all articles as defined by the parameters
     *
     * @param string $type [ all | most_liked ] The type of view
     * @param string $withPath_url Url of the view
     * @param string $order_by Column to be used to sort the results
     * @param integer $items_per_page Pagination item numbers
     * @return \Illuminate\Http\Response
     */
    private function articles($type, $withPath_url, $order_by, $items_per_page)
    {
        $articles = Article::published()->withCount('likers')->orderBy($order_by, 'desc')->paginate($items_per_page);
        $articles->withPath($withPath_url.'?items_per_page='.$items_per_page);

        return view('articles.published', [
            'articles' => $articles,
            'items_per_page' => $items_per_page,
            'type' => $type
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

    /**
    *Show list of Bookmarked Articles
    */
    public function getBookmark()
    {
        $bookmarks = \Auth::user()->bookmark()->orderBy('id', 'desc')->paginate(5);

        return view('articles.bookmarks', [
            'type' => 'bookmarks',
            'bookmarks' =>  $bookmarks
        ]);
    }
}
