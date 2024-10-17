<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validate request attributes
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $attributes['email'])->first();

        if (!$user) {
            return $this->handleInvalidCredentials
            ('The provided credentials are incorrect.');
        }

        if (is_null($user->email_verified_at)) {
            $this->sendWelcomeEmail($user);
            return $this->handleInvalidCredentials
            ('Please validate your email address. We have sent you an email.');
        }

        if (!Auth::attempt($attributes)) {
            return $this->handleInvalidCredentials
            ('The provided credentials are incorrect.');
        }

        $request->session()->regenerate();

        return redirect()->route('job.index');
    }

    protected function handleInvalidCredentials(string $message)
    {
        throw ValidationException::withMessages(['email' => $message]);
    }

    protected function sendWelcomeEmail(User $user)
    {
        $emailService = new EmailService();
        $emailService->queueWelcomeMail($user);
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('job.index');
    }

}
