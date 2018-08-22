<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'firstname', 'lastname'
    ];

    public function user() {
        return $this->belongsTo("App\Models\User");
    }
}
