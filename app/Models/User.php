<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userDetail()
    {
        return $this->hasOne("App\Models\UserDetail");
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Article', 'author_id', 'id');
    }

    public function articlesLiked()
    {
        return $this->belongsToMany('App\Models\Article', 'user_likes_article');
    }
}
