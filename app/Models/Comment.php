<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    /**
     * Retrieves the time elapsed since the comment was published from
     * the current time.
     * 
     * @param string measurement years | months | weeks ...
     * @param bool preformatted
     * 
     * @return mixed
     */
    public function time_elapse($measurement = '', $preformatted = true)
    {
        $now = Carbon::now();
        $diff = [
            'years' => $now->diffInYears($this->created_at),
            'months' => $now->diffInMonths($this->created_at),
            'weeks' => $now->diffInWeeks($this->created_at),
            'days' => $now->diffInDays($this->created_at),
            'hours' => $now->diffInHours($this->created_at),
            'minutes' => $now->diffInMinutes($this->created_at),
            'seconds' => $now->diffInSeconds($this->created_at),
        ];

        if (!$measurement) {
            foreach ($diff as $label => $elapsed) {
                if ($elapsed || $label == 'seconds') {
                    $measurement = $label;
                    break;
                }
            }
        }

        if ($preformatted) {
            return "(" . $diff[$measurement] . " " . $measurement . " ago)";
        } else {
            return $diff[$measurement];
        }
    }
}