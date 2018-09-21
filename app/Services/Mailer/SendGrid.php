<?php

namespace App\Services\Mailer;

use SendGrid as API;
use SendGrid\Mail\Mail;
use App\Services\Security\TokenDependent;

class SendGrid extends Mailer
{
    use TokenDependent;
    
    function __construct()
    {
        $this->email = new Mail();
        $this->response = null;
    }

    /**
     * Set the sender email address of the email object
     *
     * @param string $email
     * @param string|null $name
     * @return App\Services\Mailer\SendGrid
     */ 
    public function from($email, $name = null)
    {
        $this->email->setFrom($email, $name);
        return $this;
    }

    /**
     * Add the recipient's email address to the email object
     *
     * @param string $email
     * @param string|null $name
     * @return App\Services\Mailer\SendGrid
     */ 
    public function to($email, $name = null)
    {
        $this->email->addTo($email, $name);
        return $this;
    }

    /**
     * Set the subject of the email object
     *
     * @param string $subject
     * @return App\Services\Mailer\SendGrid
     */ 
    public function subject($subject)
    {
        $this->email->setSubject($subject);
        return $this;
    }

    /**
     * Set the content the email object.
     * The content must be an html parseable string.
     * 
     * @param string $content
     * @return App\Services\Mailer\SendGrid
     */
    public function content($content)
    {
        $this->email->addContent("text/html", $content);
        return $this;
    }

    /**
     * Add a custom member to the object
     * 
     * @param string $key
     * @param string $value
     * @return App\Services\Mailer\SendGrid
     */
    public function custom($key, $value)
    {
        $this->email->addCustomArg($key, $value);
        return $this;
    }

    /**
     * Send the email
     * 
     * @param array|null $data
     * @param bool $log
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send($data = null, $log = false)
    {
        // If data is passed to send, we will assume that the mail
        // object was not yet set using the the content builder. Thus,
        // we have to mass its members.
        if (is_array($data)) {
            $this->massSetEmailData($data);
        }

        // We need to create a custom mail id for the SendGrid mail
        // object for logging purposes. This custom id will reflect
        // on SendGrid's mail requests.
        $sg_mail_id = $this->generateToken();
        $this->custom("sg_mail_id", $sg_mail_id);

        try {
            $api = new API(getenv('SENDGRID_API_KEY'));
            $this->response = $api->send($this->email);
        } catch (Exception $e) {
            $status = $e->getMessage();
        }

        return back()->with('status', isset($status)
            ? $status
            : "You will receive a reset link if the email address you provided is correct.");
    }

    /**
     * Set the state of the email object
     * 
     * @param array $data
     * @return void
     */
    protected function massSetEmailData($data)
    {
        if (isset($data["from"]["email"])) {
            $from_email = $data["from"]["email"];
            $from_name = isset($data["from"]["name"]) ? $data["from"]["name"] : null;

            $this->from($from_email, $from_name);
        }

        if (isset($data["to"]["email"])) {
            $to_email = $data["to"]["email"];
            $to_name = isset($data["to"]["name"]) ? $data["to"]["name"] : null;

            $this->to($to_email, $to_name);
        }

        if (isset($data["subject"])) {
            $this->subject($data["subject"]);
        }

        if (isset($data["content"])) {
            $this->content($data["content"]);
        }
    }
}