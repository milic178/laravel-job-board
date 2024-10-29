<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function showLinkRequestForm(Request $request){
        return view('resetPassword.index');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Validate request attributes
        $attributes = $request->validate([
            'email' => 'required', 'string', 'email', 'max:255',
        ]);

        $user = User::where('email', $attributes['email'])->first();
        if (!$user) {
            return back()->with('status', 'If that email is registered, we will send a reset link.');
        }

        $token = Password::broker()->createToken($user);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        try {
            $emailService = new EmailService();
            $emailService->sendResetPasswordMail($user, $token);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send email. Please try again.']);
        }

        // Redirect to a different view with a status message
        return back()->with('status', 'Reset link sent to your email.');

    }

    public function showResetForm(Request $request, $token = null){
        return view('auth.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        // Handle password reset logic here
    }
}
