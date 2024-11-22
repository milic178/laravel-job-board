<?php

namespace App\Services;
use App\Mail\ResetPasswordMail;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;

class EmailService
{
    public function queueWelcomeMail(User $user){

        $confirmEmailUrl = URL::temporarySignedRoute(
            'confirmEmail', now()->addHours(2), ['eid' => $user->eid]
        );
        Mail::to($user->email)->queue(new WelcomeMail($user, $confirmEmailUrl));
    }

    public function sendResetPasswordMail(User $user, $token)
    {
        Mail::to($user->email)->queue(new ResetPasswordMail($user, $token));
    }
}


