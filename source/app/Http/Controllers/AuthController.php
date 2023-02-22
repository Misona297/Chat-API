<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //註冊
    public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password'])
    ]);

    $token = $user->createToken('token')->plainTextToken;
    
    return [
        'user' => $user,
        'token' => $token
    ];
}
    //登入
    public function login(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8'
    ]);

    $user = User::where('email', $validated['email'])->first();
    
    if (!$user || !Hash::check($validated['password'], $user['password'])) {
        return response([
            'message' => 'The provided credentials are incorrect.'
        ], Response::HTTP_UNAUTHORIZED);
    }

    $token = $user->createToken('apiToken')->plainTextToken;
    
    return response([
        'user' => $user,
        'token' => $token
    ], Response::HTTP_CREATED);
}

    //登出
    public function logout()
{
    Auth::user()->tokens()->delete();
    
    return  response([
        'message' => 'Logged out.'
    ],Response::HTTP_OK);
}


}
