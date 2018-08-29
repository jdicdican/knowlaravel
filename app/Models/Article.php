<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
        'title', 'body', 'published_at'
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id', 'id');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeDrafts($query)
    {
        return $query->whereNull('published_at');
    }

    public function likers()
    {
        return $this->belongsToMany('App\Models\User', 'user_likes_article');
    }

    public function likersCount()
    {
        return $this->likers()
            // ->selectRaw('article_id, count(user_id) as likes')
            // ->selectRaw('article_id count(*) as aggregate')
            // ->groupBy('article_id')
            ;
    }

    public static function likes()
    {
        $allArticles = Article::all();
        $storage = array();

        foreach($allArticles as $article) {
            $storage[$article->id] = [
                'object' => $article,
                'likers' => $article->likers->count()];
        }
        return $storage;
    }
}
