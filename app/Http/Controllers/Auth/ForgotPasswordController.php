<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\Auth\PasswordReset;
use App\Models\EmailLog;
use App\Services\Mailer\Mailer;
use App\Services\Security\TokenDependent;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    use TokenDependent;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $email_address = $request->get('email');
        $token_alias = $this->generateToken($email_address);

        // Make sure a token for the specified email is non-existent.
        // This ensures that the specified email address will not have
        // more than one (1) tokens.
        PasswordReset::where('email', 'like', $email_address)->delete();
        PasswordReset::create([
            'email' => $email_address,
            'token' => PasswordReset::generateToken($token_alias),
        ]);

        $mailer = Mailer::create(Mailer::SENDGRID);
        $data = [
            "type" => EmailLog::PASSWORD_RESET,
            "status" => EmailLog::SENT,
            "from" => [
                "email" => "noreply@knowlaravel.com",
                "name" => "Know Laravel"
            ],
            "to" => [
                "email" => $email_address
            ],
            "subject" => "Reset your password",
            "content" => "<p>You requested to reset your password.</p>
                          <p>Just click on the link below:</p>
                          <a href='".route('password.reset', ['token' => $token_alias])."'>Reset Password</a>"
            ];

        $response = $mailer->send($data);

        return $response;
    }
}
