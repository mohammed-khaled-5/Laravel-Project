<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //show register form
    public function create() {
        return view('users.register');
    }

    //create new user (submit registration form)
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        //hash password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        //login
        Auth::login($user);

        return redirect('/')->with('message', 'User created successfully!');
    }

    //logout user
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You are now logged out!');
    }

    //show login form
    public function login() {
        return view('users.login');
    }

    //login user
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(Auth::attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }




}
