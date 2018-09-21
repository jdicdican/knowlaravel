<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group','key','value'
    ];

    const GROUP_MAIL = 'mail';
    const KEY_FROM_EMAIL = 'from_email';
    const KEY_FROM_NAME = 'from_name';

    /**
     * Include settings of a given group
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    /**
     * Include settings containing the given key
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithKey($query, $key)
    {
        return $query->where('key', $key);
    }
}
