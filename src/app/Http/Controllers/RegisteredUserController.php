<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class RegisteredUserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $userAttributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            //look in users table on column email
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $employerAttributes = $request->validate([
            'employer' => ['required', 'string', 'max:255'],
            'logo' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
        ]);

        $userAttributes['eid'] = uuid_create();
        $user = User::create($userAttributes);

        $logoPath = $request->logo->store('logos');

        $user->employer()->create([
            //as attribute assigned in view(register.blade.php)
            'name' => $employerAttributes['employer'],
            'logo' => $logoPath ?? null
        ]);

        Auth::login($user);
        $this->queueWelcomeMail($user);

        return redirect()->route('job.index');
    }

    public function queueWelcomeMail(User $user){

        $confirmEmailUrl = URL::temporarySignedRoute(
            'confirmEmail', now()->addWeeks(1), ['eid' => $user->eid]
        );

        error_log("\n confirmEmailUrli : ".$confirmEmailUrl."\n");
        Mail::to($user->email)->queue(new WelcomeMail($user, $confirmEmailUrl));
    }
}
