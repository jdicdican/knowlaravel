<?php

namespace App\Services\Mailer;

use App\Services\Mailer\SendGrid;

abstract class Mailer
{
    /**
     * The email object
     * 
     * @var \SendGrid\Mail\Mail
     */
    protected $email;

    /**
     * The API's response after sending the email
     * 
     * @var \SendGrid\Response
     */
    protected $response;

    /**
     * Mail driver identifier constant
     * 
     * @var integer
     */
    const SENDGRID = 1;

    /**
     * Create a new mailer object using the specified driver
     * 
     * @param int $driver
     * @return App\Services\Mailer\SendGrid|null
     */
    public static function create($driver)
    {
        switch ($driver) {
            case self::SENDGRID:
                return new SendGrid();
                break;
            default:
                return null;
        }
    }

    public abstract function send($data, $log = false);
    protected abstract function massSetEmailData($data);
}