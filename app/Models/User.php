<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'user_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Constant definition of the user roles
     *
     * @var int ADMIN   Administrator of the page
     * @var int AUTHOR  Author of articles
     * @var int REGULAR Regular browser of the website
     */
    const ADMIN = 1, AUTHOR = 2, REGULAR = 3;

    /**
     * Gets the user's user detail
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userDetail()
    {
        return $this->hasOne("App\Models\UserDetail");
    }

    /**
     * Gets the articles authored by the user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article', 'author_id', 'id');
    }

    /**
     * Gets the articles that the user liked
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articlesLiked()
    {
        return $this->belongsToMany('App\Models\Article', 'user_likes_article');
    }

    /**
     * Returns true if user is admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->user_type==1;
    }

    public function bookmarks()
    {
        return $this->belongsToMany('App\Models\Article', 'users_bookmarks_article');
    }
    /**
     * Gets the comments made by the user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function getDisplayName()
    {
        $fullname = trim($this->userDetail->firstname.' '.$this->userDetail->lastname);
        $display_name = $this->email;

        if($fullname) {
            $display_name = $fullname;
        } else if($this->username) {
            $display_name = $this->username;
        }

        return $display_name;
    }
    //get User Types of User and print them as Text
    public function getUserType()
    {
        $display_user_type = "Regular User";

        if ($this->user_type == 1) {
            $display_user_type = "Admin";
        } else if ($this->user_type == 2){
            $display_user_type = "Author";
        }
        return $display_user_type;
    }

}
