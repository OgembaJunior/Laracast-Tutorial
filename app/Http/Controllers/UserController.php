<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');

    }

    public function register()
    {
        return view('auth.register');

    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name'=>['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']

        ]);


        $fields['password'] = bcrypt($fields['password']);


        $user = User::create($fields);
        auth()->login($user);
        return redirect('/');
        
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'=> 'required|string|email',
            'password' => 'required|string',
        ]);


        $credentials = $request->only('email', 'password');

        $user = auth()->attempt($credentials);

        if($user)
        {
            $request->session()->regenerate();
            return redirect('/');
        }


        return redirect('/sign-in')
                ->with('message', "Wrong credentials");     
        
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
       
    }

}
