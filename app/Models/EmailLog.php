<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $table = 'email_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type',
        'from_name',
        'from_email',
        'to_name',
        'to_email',
        'subject',
        'message',
        'status',
        'mail_id'
    ];

    const PASSWORD_RESET = 'password_reset';
    const SENT = 'sent';
        /**
     * You can also set the $guarded property which prevents the listed columns from mass assignment.
     *
     * @var array
     */
    protected $guarded = ('id');

    public function user()
    {
        $this->belongsTo('User');
    }

}
