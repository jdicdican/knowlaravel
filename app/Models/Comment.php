<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','article_id','body'
    ];

    /**
     * Gets the user who wrote the comment
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function writer()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Gets the article the comment belongs to
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}