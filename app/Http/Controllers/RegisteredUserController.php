<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $validatedAttributes = Request()->validate([
            'name'=> ['required'],
            'email'=> ['required'],
            'password'=> ['required', Password::min(7), 'confirmed']
        ]);

        $user = User::create($validatedAttributes);

        Auth::login($user);

        return redirect('/jobs');
    }
}
