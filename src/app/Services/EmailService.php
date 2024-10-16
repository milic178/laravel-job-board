<?php

namespace App\Services;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EmailService
{
    public function queueWelcomeMail(User $user){

        $confirmEmailUrl = URL::temporarySignedRoute(
            'confirmEmail', now()->addHours(2), ['eid' => $user->eid]
        );

        //todo remove dev log
        //error_log("\n confirmEmailUrli : ".$confirmEmailUrl."\n");
        Mail::to($user->email)->queue(new WelcomeMail($user, $confirmEmailUrl));
    }
}


