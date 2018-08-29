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
}
