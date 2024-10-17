<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user){

        dd('UserController show vidw');
        return view('user.show', compact('user'));
    }

    public function store(Request $request){

    }

    public function update(Request $request){

    }

    public function edit(User $user)
    {

    }

    public function destroy(User $user){

    }
}
