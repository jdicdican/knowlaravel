<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleSave;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::whereNotNull('published_at');

        return $articles;
    }

    public function create()
    {
        \Auth::user()->user_type != 2 ? abort(403) : '';

        return view('articles.edit')->with([
            'method' => 'create'
        ]);
    }

    public function save(ArticleSave $request, $id = NULL)
    {
        \Auth::user()->user_type != 2 ? abort(403) : '';
        
        $article = \Auth::user()->articles()->where('id', $id);
        $date = $request['is_draft'][0] == 1 ? NULL : date('Y-m-d H:i:s');
        $data = [
            'title' => $request['title'],
            'body' => $request['body'],
            'published_at' => $date
        ];

        if ($id == NULL) { // create new article
            \Auth::user()->articles()->create($data);
        } else if ($id != NULL) {
            if($article) { // if user owns the article... update the article
                $article->update($data);
            }
        }

        return redirect()->route('published');
    }

    public function delete($articleID) {
        $article = Article::find($articleID);

        if(\Auth::user()->articles->contains($articleID)) {
            $article->delete();

            return redirect()->back();
        } else {
            abort(403);
        }
    }

    public function update($articleID) {
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

    public function like($articleID) {
        if (\Auth::user()->articlesLiked->contains($articleID)) {
            \Auth::user()->articlesLiked()->detach($articleID);
        } else {
            \Auth::user()->articlesLiked()->attach($articleID);
        }
        return redirect()->back();
    }
}