<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthControllerApi extends Controller
{
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:users',
            'email' => 'required|string|unique:users,email',
            'password_confirmation' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $errors,
            ], 422); 
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        $user->save();

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
    

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $errors,
            ], 422); 
        }

        // Check email
        $user = User::where('email', $request->input('email'))->first();

        // Check password
        if(!$user || !Hash::check($request->input('password'), $user->password)) {
            return response([
                'errors' => ['invalid'=>'Invalid credentials']
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return [
            'message' => 'Logged out'
        ];
    }
}
