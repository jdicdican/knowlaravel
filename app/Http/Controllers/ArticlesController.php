<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Comment;
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
     * Lets user create a new article or update an existing article
     *
     * @param App\Http\Requests\ArticleSave $request
     * @param integer $articleID
     * @return Illuminate\Http\RedirectResponse
     */
    public function save(ArticleSave $request)
    {
        $articleID = $request->input('article_id');
        $date = $request->input('is_draft') ? NULL : date('Y-m-d H:i:s');
        $data = [
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'published_at' => $date
        ];

        if ($articleID == NULL) { // create new article
            $article = \Auth::user()->articles()->create($data);
        } else { // update existing article
            $article = Article::find($articleID);
            $article->update($data);
        }

        return response()->json([
            'status'=>'success',
            'redirect'=>route('view-article', ['id'=>$article->id])
        ]);
    }

    /**
     * Lets user perform a delete action on an article
     *
     * @param Illuminate\Http\Request $request
     * @return array
     */
    public function delete(Request $request)
    {
        $articleID = $request->input('article_id');

        if(!\Auth::user()->articles->contains($articleID)) {   
            die('User is not the author of the article to be deleted.');
        }

        $article = Article::find($articleID);
        $article->delete();
        
        return response()->json([
            'status'=>'success',
        ]);
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
        if(\Auth::user()->articles->contains($articleID)) {   
            $article = Article::find($articleID);
            return view('articles.edit')->with([
                'method' => 'update',
                'article' => $article
            ]);
        }

        return view('errors.403');
    }

    /**
     * Lets user perform a like action on an article
     *
     * @param Illuminate\Http\Request $request
     * @return array
     */
    public function like(Request $request)
    {
        $articleID = $request->input('article_id');
        if (\Auth::user()->articlesLiked->contains($articleID)) {
            \Auth::user()->articlesLiked()->detach($articleID);
        } else {
            \Auth::user()->articlesLiked()->attach($articleID);
        }
        
        return response()->json([
            'status'=>'success',
        ]);
    }

    /**
     * Shows the article / post with the specified $articleID
     * 
     * @param integer $articleID
     * @return Illuminate\Http\RedirectResponse
     */
    public function view($articleID)
    {
        $article = Article::find($articleID);

        return view('articles.article')->with([
            "article" => $article
        ]);
    }

    /**
     * Lets user comment on an article
     * 
     * @param Illuminate\Http\Request $request
     * @return array
     */
    public function comment(Request $request)
    {
        $user = \Auth::user();
        $article = Article::find($request->input('article_id'));

        $comment = new Comment;
        $comment->writer()->associate($user);
        $comment->article()->associate($article);
        $comment->body = $request->input('comment');
        $comment->save();

        return response()->json([
            'status'=>'success',
        ]);
    }
}
