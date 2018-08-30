<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'published_at'
    ];

    /**
     * Gets the article's author
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id', 'id');
    }

    /**
     * Gets the users who likes the article
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany 
     */
    public function likers()
    {
        return $this->belongsToMany('App\Models\User', 'user_likes_article');
    }

    /**
     * Scope query to only include published articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    /**
     * Scope query to only include draft articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDrafts($query)
    {
        return $query->whereNull('published_at');
    }
}
