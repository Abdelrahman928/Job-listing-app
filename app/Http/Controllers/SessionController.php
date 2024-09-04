<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(){
        $validatedAttributes = Request()->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if(! Auth::attempt($validatedAttributes)){
            throw ValidationException::withMessages([
                'email' => 'we could not find a user for this email in our database!',
                'password' => 'incorrect password!'
            ]);
        }

        Auth::attempt($validatedAttributes);

        request()->session()->regenerate();

        return redirect('/jobs');
    }

    public function destroy(){
        Auth::logout();
        return redirect('/');
    }
}
