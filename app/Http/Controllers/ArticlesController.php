<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Http\Requests\ArticleSave;

class ArticlesController extends Controller
{
    /**
     * Show the post creation page
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.edit')->with([
            'method' => 'create'
        ]);
    }

    /**
     * Creates a new article if $articleID is NULL; updates the existing
     * article if otherwise
     *
     * @param App\Http\Requests\ArticleSave $request
     * @param integer $articleID
     * @return Illuminate\Http\RedirectResponse
     */
    public function save(ArticleSave $request, $articleID = NULL)
    {
        \Auth::user()->user_type != 2 ? abort(403) : '';

        $article = \Auth::user()->articles()->where('id', $articleID);
        $date = $request['is_draft'][0] == 1 ? NULL : date('Y-m-d H:i:s');
        $data = [
            'title' => $request['title'],
            'body' => $request['body'],
            'published_at' => $date
        ];

        if ($articleID == NULL) { // create new article
            \Auth::user()->articles()->create($data);
        } else if ($article) { // if user owns the article... update the article
            $article->update($data);
        }

        return redirect()->route('published');
    }

    /**
     * Deletes the article with the id $articleID
     *
     * @param integer $articleID
     * @return Illuminate\Http\RedirectResponse
     */
    public function delete($articleID)
    {
        $article = Article::find($articleID);

        if(\Auth::user()->articles->contains($articleID)) {
            $article->delete();

            return redirect()->back();
        } else {
            abort(403);
        }
    }

    /**
     * Show the post creation page with data from the article which is
     * to be updated
     *
     * @param integer $articleID
     * @return \Illuminate\Http\Response
     */
    public function update($articleID)
    {
        $article = Article::find($articleID);

        if(\Auth::user()->articles->contains($articleID)) {
            return view('articles.edit')->with([
                'method' => 'update',
                'id' => $article->id,
                'title' => $article->title,
                'body' => $article->body
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Likes the article with $articleID; unlikes if the user already
     * liked it
     *
     * @param integer $articleID
     * @return Illuminate\Http\RedirectResponse
     */
    public function like($articleID)
    {
        if (\Auth::user()->articlesLiked->contains($articleID)) {
            \Auth::user()->articlesLiked()->detach($articleID);
        } else {
            \Auth::user()->articlesLiked()->attach($articleID);
        }
        return redirect()->back();
    }
}
