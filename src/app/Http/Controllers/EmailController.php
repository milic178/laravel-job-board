<?php

namespace App\Http\Controllers;

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

        // Check if the signature is valid
        if (!$request->hasValidSignature()) {
            abort(403, 'Invalid or expired link.');
        }

        // Retrieve the eid from the query parameters
        $eid = $request->query('eid');

        // Find the user based on the EID
        $user = User::where('eid', $eid)->first();

        // Check if the user exists
        if (!$user) {
            abort(404, 'User not found');
        }

        // Check if the user has already verified their email
        if ($user->email_verified_at) {
            return response()->json(['message' => 'Email is already verified.'], 409);
        }

        $user->email_verified_at = now();
        $user->save();

        return view('emailConfirmed');
    }

    //todo remove test function
    public function testEmail(Request $request){

    }
}
