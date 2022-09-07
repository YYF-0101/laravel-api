<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed'
            ]);
        $user = User::create([
                'email' => $fields['email'],
                'password' => bcrypt($fields['password'])
            ]);

        $response = [
                'user' => $user
            ];
        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //check email
        $user = User::where('email',$fields['email'])->first();

        //check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'email or password does not match our records'
            ],401);
        }

        $token = $user->createToken('myapptoken') -> plainTextToken;

        $response = [
            'user'=>$user,
            'token'=> $token,
        ];

        return response($response,201);
    }
}
