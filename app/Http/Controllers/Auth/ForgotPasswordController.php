<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\Auth\PasswordReset;

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
        $token_alias = hash('sha256', $email_address.date("D M d, Y G:i"));

        PasswordReset::where('email', 'like', $email_address)->delete(); // Make sure a token for the specified email is non-existent
        PasswordReset::create([
            'email' => $email_address,
            'token' => PasswordReset::generateToken($token_alias),
        ]);

        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("noreply@knowlaravel.com", "Password Reset");
        $email->setSubject("Reset your password");
        $email->addTo($request->get('email'));
        $email->addContent(
            "text/html", "<a href='".route('password.reset', ['token' => $token_alias])."'>Click here to reset your password</a>"
        );
        
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            $status = "You will receive a reset link if the email address you provided is correct.";
        } catch (Exception $e) {
            $status = $e->getMessage();
        }

        return back()->with('status', $status);
    }
}
