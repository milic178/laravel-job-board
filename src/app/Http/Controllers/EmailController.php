<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailConfirmationException;
use App\Mail\ResetPasswordMail;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function confirmEmail(Request $request)
    {
        if (!$request->hasValidSignature()) {
            throw new EmailConfirmationException('Invalid or expired link. Please request a new confirmation link by logging in.', 410);
        }

        $eid = $request->query('eid');

        $user = User::where('eid', $eid)->first();

        if (!$user) {
            throw new EmailConfirmationException('Invalid or expired link. Please request a new confirmation link by logging in.', 410);
        }

        if ($user->email_verified_at) {
            throw new EmailConfirmationException('Your email has already been confirmed.', 409);
        }

        $user->email_verified_at = now();
        $user->save();

        return view('emailConfirmed');
    }

    /** used to test email views by accessing /testEmail,
     * check web.php and uncomment the path
     */
    public function testEmailView(Request $request)
    {
        $lastUser = \App\Models\User::latest()->first();

        $mailable = new ResetPasswordMail($lastUser, 'https://www.perplexity.ai/search/aravel-how-do-i-get-all-employ-0TYlDKraQsmxlz.Og6fAOw');

        $mailable = new WelcomeMail($lastUser, 'urlurl');

        return $mailable->render();
    }
}
