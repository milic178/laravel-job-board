<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetTokens;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $token = hash('sha256', (string) uuid_create());

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
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

    public function showResetForm(Request $request, $token){

        $passwordResetToken = PasswordResetTokens::where('token', $token)->first();
        if(!$passwordResetToken){
            return redirect()->route('password.reset.request')
            ->with('error', 'Invalid token, please request a new password reset link.');
        }

        $tokenCreatedAt = $passwordResetToken->created_at;

        if (now()->greaterThan($tokenCreatedAt->addHour())) {
            return redirect()->route('password.reset.request')
                ->with('error', 'Invalid token, more than 1h passed since token was requested. Please request a new password reset link.');
        }

        $user = User::where('email', $passwordResetToken->email)->first();
        if(!$user){
            return redirect()->route('password.reset.request')
                ->with('error', 'Invalid token, please request a new password reset link.');
        }

        return view('resetPassword.reset-password')->with(['token' => $token]);
    }

    public function reset(Request $request)
    {
        $userAttributes = $request->validate([
            'token' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $token = $userAttributes['token'];
        $passwordResetToken = PasswordResetTokens::where('token', $token)->first();
        if(!$passwordResetToken){
            error_log('No password token found');
            return redirect()->route('password.reset.request')
                ->with('error', 'Invalid token, please request a new password reset link.');
        }

        $user = User::where('email', $passwordResetToken->email)->first();
        if(!$user){
            error_log('No user found');

            return redirect()->route('password.reset.request')
                ->with('error', 'Invalid token, please request a new password reset link.');
        }

        try{

            if (!empty($userAttributes['password'])) {
                $user->password = bcrypt($userAttributes['password']);
                $user->save();
                //todo find workaround to load another time, cannot use ->delete as table has no ids, or make migration
                PasswordResetTokens::where('token', $token)->delete();
            }
        }
        catch(\Exception $e){
            error_log('Error password update details: '. $e->getMessage());
            return redirect()->route('password.reset.request')
                ->with('error', 'Invalid token, please request a new password reset link.');
        }

        return view('resetPassword.reset-password-success');


        /**
         * Update the User’s Password:
         *
         * Invalidate the reset token (usually done automatically if using Laravel's built-in functionality).
         *
         * Provide Feedback: Redirect the user to a confirmation page or display a success message indicating that their password has been successfully reset.
         */
    }
}
