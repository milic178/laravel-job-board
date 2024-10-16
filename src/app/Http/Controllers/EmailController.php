<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailConfirmationException;
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

    //todo remove test function
    public function testEmail(Request $request)
    {

    }
}
