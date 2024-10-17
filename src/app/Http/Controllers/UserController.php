<?php

namespace App\Http\Controllers;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show(User $user){

    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        if ($request->user()->cannot('edit', $user)) {
            abort(403, 'You are not allowed to edit this user');
        }
        return view('user.edit', compact('user'));
    }


    public function update(Request $request){

        /** @var User $user */
        $user = Auth::user();
        if ($request->user()->cannot('update', $user)) {
            abort(403, 'You are not allowed to update this user');
        }

        //todo refactor

        $userAttributes = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $employerAttributes = $request->validate([
            'employer_name' => ['required', 'string', 'max:255'],
            'employer_logo' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'employer_description' => 'nullable', 'max:1000',
        ]);

        if($request->has('name') && $user->name !== $userAttributes['name']) {
            $user->name = $userAttributes['name'];
        }

        // Check if email has changed and is unique update if necessary
        if ($request->has('email') && $user->email !== $userAttributes['email']) {
            $emailValidated = request()->validate(['email' => ['unique:users,email']]);
            $user->email = $emailValidated['email'];
        }

        // Check if password has been provided and update if necessary
        if ($request->has('password') && !empty($userAttributes['password'])) {
            $user->password = bcrypt($userAttributes['password']); // Hash the new password
        }

        $successMessage = '';

        // Save the user model only if there are changes
        if ($user->isDirty()) {
            
            $user->save();
            $successMessage = 'User profile updated successfully!';
        }

        /** @var Employer $employer */
        $employer = $user->employer;

        if($request->has('employer_name') && $employer->name !== $employerAttributes['employer_name']) {
            $employer->name = $employerAttributes['employer_name'];
        }


        if($request->has('employer_description') && $employer->description !== $employerAttributes['employer_description']) {
            $employer->description = $employerAttributes['employer_description'];
        }


        if($request->hasFile('employer_logo') && $employer->logo !== $employerAttributes['employer_logo']) {
            $employer->logo =$request->file('employer_logo')->store('logos');
        }


        if ($employer->isDirty()) {
            $employer->save();
            $successMessage = 'Employer profile updated successfully!';
        }

        return redirect()->route('user.edit')->with('success', $successMessage);
    }


    public function store(Request $request){
        //already done in RegistrationUserController
    }


    public function destroy(User $user){
        //todo
    }
}
