<?php

namespace App\Services\Mailer;

abstract class Mailer
{
    /**
     * The email object
     * 
     * @var mixed
     */
    protected $email;

    /**
     * The API's response after sending the email
     * 
     * @var mixed
     */
    protected $response;

    public abstract function from($email, $name = null);
    public abstract function to($email, $name = null);
    public abstract function subject($subject);
    public abstract function content($content);
    public abstract function send($data, $log = false);
    protected abstract function massSetEmailData($data);
}