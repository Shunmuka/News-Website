<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showRegisterScreen () {
        return view('register');
    }

    public function logout () {
        auth()->logout();
        return redirect('/');
    }


    public function register (Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:32'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone_number' => ['required', Rule::unique('users', 'phone_number')],
            'address' => ['required'],
            'password' => ['required', 'min: 8', 'max: 200']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);

        return redirect('/');
    }

    public function login (Request $request) {
        $incomingFields = $request->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);
    
        if (auth()->attempt(['email' => $incomingFields['email'], 'password' => $incomingFields['password']])) {
            $request->session()->regenerate();
            return redirect('/createPost');
        } else {
            return redirect('/')->withErrors([
                'login_error' => 'Invalid email or password.',
            ]);
        }
    }
    
}