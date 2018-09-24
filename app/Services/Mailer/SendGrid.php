<?php

namespace App\Services\Mailer;

use SendGrid as API;
use SendGrid\Mail\Mail;
use App\Services\Security\TokenDependent;
use App\Models\Setting;
use App\Models\EmailLog;

class SendGrid extends Mailer
{
    use TokenDependent;

    /**
     * Send the email
     *
     * @param array|null $data
     * @param bool $log
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send($data, $log = true)
    {
        // Always create a new Mail object whenever trying to send.
        // Assign values to the object afterwards.
        $this->email = new Mail();
        $this->massSetEmailData($data);

        // We need to create a custom mail id for the SendGrid mail
        // object (for logging purposes). This custom id will reflect
        // on SendGrid's mail requests.
        $sg_mail_id = $this->generateToken();
        $this->email->addCustomArg("sg_mail_id", $sg_mail_id);

        try {
            $api = new API(getenv('SENDGRID_API_KEY'));
            $this->response = $api->send($this->email);
        } catch (Exception $e) {
            $status = $e->getMessage();
        } finally {
            if( $log ) {
                $this->log($data, $sg_mail_id);
            }
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

            $this->email->setFrom($from_email, $from_name);
        } else {
            $this->email->setFrom(Setting::getValue(Setting::GROUP_MAIL, Setting::KEY_FROM_EMAIL),
                                  Setting::getValue(Setting::GROUP_MAIL, Setting::KEY_FROM_NAME));
        }

        if (isset($data["to"]["email"])) {
            $to_email = $data["to"]["email"];
            $to_name = isset($data["to"]["name"]) ? $data["to"]["name"] : null;

            $this->email->addTo($to_email, $to_name);
        }

        if (isset($data["subject"])) {
            $this->email->setSubject($data["subject"]);
        }

        if (isset($data["content"])) {
            $this->email->addContent("text/html", $data["content"]);
        }
    }

    public function log($data, $sg_mail_id)
    {

        EmailLog::create([
            'type' => $data['type'],
            'from_name' => isset($data['from']['name']) ? $data['from']['name'] : null,
            'from_email' => $data['from']['email'],
            'to_name' => isset($data['to']['name']) ? $data['to']['name'] : null,
            'to_email' => $data['to']['email'],
            'subject' =>  $data['subject'],
            'message' => $data['content'],
            'status' => $data['status'],
            'mail_id' => $sg_mail_id
        ]);
    }
}
