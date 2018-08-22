<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'firstname', 'lastname'
    ];
}
