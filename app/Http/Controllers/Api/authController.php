<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
        public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create($request->all());

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function login(Request $request)
    {

        $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string|min:8',
        ]);

        //user check by email
        $user = User::where('email', $request->email)->first();

        if($user->status = 1){  // = !empty
            
            if (Hash::check($request->password, $user->password)) {       //if (password_verify($request->password, $user->password)
                //create token
                $token = $user->createToken('API Token')->plainTextToken;
                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user,
                    'token' => $token], 200);
            } else {
                return response()->json(['message' => 'Incorrect password'], 401);
            }
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
}

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}